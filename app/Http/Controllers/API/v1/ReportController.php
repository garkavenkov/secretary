<?php

namespace App\Http\Controllers\API\v1;

use Exception;
use App\Models\Settlement;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use App\Models\HouseholdMember;
use PhpOffice\PhpWord\IOFactory;

use PhpOffice\PhpWord\Style\Font;
use App\Http\Controllers\Controller;
use App\Models\HouseholdMemberLand;
use DateTime;
use DateTimeImmutable;
use DeclensionUkrainian\Anthroponym;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use JsonException;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpKernel\Exception\HttpException;

use function PHPUnit\Framework\throwException;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return available reports
        // $reports = Report::all()
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Generate the specified report
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        if (!isset($request->report)) {
            return response()->json(['message' => 'Report did not pass'], 404);
        }
        // Select from DB info about report: variables, etc.

        $report = $request->report;
        if (!method_exists($this, $report)) {
            return response()->json(['message' => 'Report does not exist'], 500);
        }
        
        $res = call_user_func(array($this, $report), $request->all());

        return response()->json($res);
    }

    protected function membersByAge($params)
    {
        $sex = null;
        $date = date('Y-m-d');
        $settlement_id = isset($params['settlementId']) ? (int) $params['settlementId'] : 0;
        
        if ($settlement_id !== 0) {
            $settlements = Settlement::where('id', $settlement_id)->get();
        } else {            
            $settlements = Settlement::whereIn('id',[1,2])->get();
        }        

        if (isset($params['date'])) {
            $date = $params['date'];
        }

        if (isset($params['sex']) && ($params['sex'] != 0)) {
            $sex = $params['sex'];
        }

        $result = [];
        
        $age_ranges = [
            '0 - 17'    =>  [0,17],
            '18 - 35'   =>  [18, 35],
            '36 - 59'   =>  [36, 59],
            '60 - 69'   =>  [60, 69],
            '70 - 79'   =>  [70, 79],
            '80 - 89'   =>  [80, 89],
            '> 90'      =>  [90, 200]
        ];

        $settlements->each(function($s) use($sex, $date , $age_ranges, &$result) {        

            $members = $s->membersByAge(sex: $sex, date: $date, ages: $age_ranges);

            $settlement_total = 0;
            if (isset($members['чоловіча']['total'])) {
                $settlement_total += $members['чоловіча']['total'];
            }
            if (isset($members['жіноча']['total'])) {
                $settlement_total += $members['жіноча']['total'];
            }


            $data = [
                'settlement'=> $s->name,
                'data'      => $members,
                'total'     => $settlement_total
            ];

            $result[] = $data;

        });
        
        return $result;

    }

    protected function adultsAndChildren($params)
    {
        $date = date('Y-m-d');
        $settlement_id = isset($params['settlementId']) ? (int) $params['settlementId'] : 0;
        
        if ($settlement_id !== 0) {
            $settlements = Settlement::where('id', $settlement_id)->get();
        } else {            
            $settlements = Settlement::whereIn('id',[1,2])->get();
        }        
        
        if (isset($params['date'])) {
            $date = $params['date'];
        }

        $result = [];

        $age_ranges = [            
            'children' => [
                '0 - 5'     =>  [0,5],
                '6 - 13'    =>  [6, 13],
                '14 - 17'   =>  [14, 17],
            ],
            'adults' => [
                '18 - 60'   =>  [18, 60],            
                '> 60'      =>  [61, 200]            
            ]
        ];

        $settlements->each(function($s) use($date, &$result) {
            $res = [];
            $res['settlement'] = $s->name;
            $res['households_total']   = $s->households->count();
            $res['households_living']  = $s->households([1,2])->count();

            $members_active = $s->members()->active($date)->get();            
            
            $members            = $members_active
                                    ->transform(function($member) use($date) {
                                        $age = (new \DateTime($member->birthdate))->diff(new \DateTime($date))->y;
                                        return $age;
                                    })
                                    ->groupBy(function($item) {
                                            if ($item < 6) {
                                                return '0-5';
                                            } else if ($item >= 6 and $item < 14) {
                                                return '6-13';
                                            } else if ($item >= 14 and $item < 18) {
                                                return '14-17';
                                            } else if ($item >= 18 and $item <=60 ) {
                                                return '18-60';
                                            } else {
                                                return '>60';
                                            }
                                    })
                                    ->transform(function($age) {
                                        return $age->count();
                                    })
                                    ->all();

            $res['children']['0-5']      = $members['0-5'] ?? 0;
            $res['children']['6-13']     = $members['6-13'] ?? 0;
            $res['children']['14-17']    = $members['14-17'] ?? 0;
            $res['adults']['18-60']      = $members['18-60'] ?? 0;
            $res['adults']['>60']        = $members['>60'] ?? 0;

            $res['children']['total'] = array_reduce($res['children'], function($total, $item) {
                $total += $item;
                return $total;
            });
            $res['adults']['total'] = array_reduce($res['adults'], function($total, $item) {
                $total += $item;
                return $total;
            });
            // Use $members_active for further calculation.
            // Add items (disabled, child_disabled etc.) into $members_active collection

            $result[] = $res;
        });

        return $result;
    }


    public function familyComposition($params)
    {
        try {
            $templateProcessor = new TemplateProcessor(storage_path('app/documents/FamilyComposition.docx'));
        } catch (Exception $e) {

            $msg = 'Шаблон звіту FamilyComposition.docx не знайден. Завантажіть шаблон';
            throw new Exception($msg,500);

        }

        if(!isset($params['member_id'])) {
            throw new Exception('Member did not pass');
        }
        $member = HouseholdMember::findOrFail($params['member_id']);
        $member_name = $member->surname . ' ' . $member->name . ' ' . $member->patronymic;
        $member_birthdate =  (new DateTimeImmutable($member->birthdate))->format('d.m.Y');
        
        $person_pronoun = 'ним';

        if ($member->sex == 'жіноча')  {        
            $person_pronoun = 'нею';
        }

        if (isset($params['relatives'])) {
            $ids = explode(',', $params['relatives']);

            $relatives = $member->relatives()->filter(function($r) use($ids) {
                return in_array($r->id, $ids);
            });

        } else {
            $relatives = [];
        }

        $address =$member->household->getFullAddress();

        $person_address_registration = ($member->sex == 'чоловіча' ? 'зареєстрований' : 'зареєстрована') .
                                        " за адресою: $address";

        // $templateProcessor = new TemplateProcessor(storage_path('app/documents/FamilyComposition.docx'));
        // $phpWord = new PhpWord();
        $templateProcessor->setValue('person_pronoun', $person_pronoun);
        $templateProcessor->setValue('person_name', $member_name);
        $templateProcessor->setValue('person_birthdate', $member_birthdate);
        $templateProcessor->setValue('person_address_registration', $person_address_registration);


        $rels = [];

        foreach($relatives as $relative) {
            $rel['relative'] =  "$relative->relation - $relative->surname $relative->name $relative->patronymic, " .
                                (new DateTimeImmutable($relative->birthdate))->format('d.m.Y') .
                                ' р.н.,';
            $rels[] = $rel;
        }

        $templateProcessor->cloneBlock('relatives', 0, true, false, $rels);

        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document;charset=utf-8');
        header("Content-Disposition: attachment; filename='familyComposition.docx");

        $templateProcessor->saveAs('php://output');
    }


    public function uploadTemplate(Request $request, $id)
    {
        $path = $request->file->store('templates');

        // dd($path, Storage::path($path));
        $variables = [];
        try {
            // $templateProcessor = new TemplateProcessor(storage_path($path));
            $templateProcessor = new TemplateProcessor( Storage::path($path));
            // $templateProcessor = new TemplateProcessor($request->file);
            // dd($templateProcessor);
            $variables = $templateProcessor->getVariables();

        } catch (Exception $e) {
            $msg = 'Шаблон звіту FamilyComposition1.docx не знайден. Завантажіть шаблон';
            throw new Exception($msg,500);
        }
        return response()->json(['message' => 'Шаблон був успішно завантажен', 'variables' => $variables]);
        // dd($path);
    }

    public function landOwned($params)
    {
        if(!isset($params['member_id'])) {
            throw new Exception('Member did not pass', 500);
        }
        if (!isset($params['year'])) {
            throw new Exception('Year does not passed', 500);
        }

        $member = HouseholdMember::findOrFail($params['member_id']);

        $year = HouseholdMemberLand::where('year', $params['year'])->where('member_id', $params['member_id'])->first();

        if (is_null($year)) {
            throw new Exception("Інформація за ". $params['year'] . " відсутня", 404);
        }

        try {
            $templateProcessor = new TemplateProcessor(storage_path('app/documents/LandOwned.docx'));
        } catch (Exception $e) {

            $msg = 'Шаблон звіту LandOwned.docx не знайден. Завантажіть шаблон';
            throw new Exception($msg,500);

        }
        // dd($templateProcessor->getVariables());

        $member = HouseholdMember::findOrFail($params['member_id']);
        $member_name = $member->surname . ' ' . $member->name . ' ' . $member->patronymic;


        $member_name = Anthroponym::inDative([
            'gender'    =>  $member->sex,
            'surname'   =>  $member->surname,
            'name'      =>  $member->name,
            'patronymic'=>  $member->patronymic,
        ]);
        //  ReportVariable::where('report', $report)->where('name','member_name')->first(); ($member_name) ????
        //  person_name => Anthroponym::inDative($member) ?????

        $member_birthdate =  (new DateTimeImmutable($member->birthdate))->format('d.m.Y');

        $address =$member->household->getFullAddress();

        $person_address_registration = ($member->sex == 'чоловіча' ? 'зареєстрований' : 'зареєстрована') .
                                        " за адресою: $address";

        $templateProcessor->setValue('person_name', $member_name);
        $templateProcessor->setValue('person_birthdate', $member_birthdate);
        $templateProcessor->setValue('person_address_registration', $person_address_registration);
        $templateProcessor->setValue('land_year', $params['year']);
        $templateProcessor->setValue(
            'land_total',
            $year->total > 0 ? (number_format($year->total, 4) . ' га') : 'немає'
        );

        $templateProcessor->setValue(
            'land_maintenance',
            $year->maintenance > 0 ? (number_format($year->maintenance, 4) . ' га'): 'немає'
        );
        $templateProcessor->setValue(
            'land_personal_agriculture',
            $year->personal_agriculture > 0 ? (number_format($year->personal_agriculture, 4). ' га') : 'немає
        ');
        $templateProcessor->setValue(
            'land_share',
            $year->land_share > 0 ? (number_format($year->land_share, 4) . ' га') : 'немає'
        );
        $templateProcessor->setValue(
            'land_property_share',
            $year->property_share > 0 ? (number_format($year->property_share, 4). ' га') : 'немає'
        );
        $templateProcessor->setValue(
            'land_hay_cutting',
            $year->hay_cutting > 0 ? (number_format($year->hay_cutting, 4) . ' га') : 'немає'
        );
        $templateProcessor->setValue(
            'land_pastures',
            $year->pastures > 0 ? (number_format($year->pastures, 4) . ' га') : 'немає'
        );

        // for($tv in $report_variables) {
        //
        //      $report_value = $report_entities[$tv]['value']              --- maintenance
        //      $report_value_format = $report_entities[$tv]['format']      --- number:4
        //      $report_value_prefix = $report_entities[$tv]['prefix']      --- 'га'
        //      $report_value_default = $report_entities[$tv]['default']    --- 'немає'
        //
        //
        //      $templateProcessor->setValue($tv, generate_report_value($report_variable[$tv]));
        // }

        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document;charset=utf-8');
        header("Content-Disposition: attachment; filename='landOwned.docx");


        $templateProcessor->saveAs('php://output');

    }

    public function generateReport(Request $request)
    {
        // Income parameters:
        // $report_name = $request->report_name

        // $parameters  = explode(';',$request->params);
        /*
            report: family_composition
            params: member_id=1;relatives_ids=2,3,4,5

            report: member_land
            params: member_id=1;year=2020
        */

        // Check whether report exists in DB;
        /*
            $report = Report::where('code', $report_name)->first();
            if (!$report) {
                $msg = 'Звіту $report->name відсутній в системі. Зверниться до довідника звітів.';
                throw new Exception($msg,500);
            }
        */

        // Check id report's template exists
        /*
            try {
                $templateProcessor = new TemplateProcessor(storage_path('app/documents/$report->template'));
            } catch (Exception $e) {
                $msg = 'Шаблон звіту $report->template не знайден. Завантажіть шаблон';
                throw new Exception($msg,500);
            }
        */

        // Check report input parameters based on report
        /*
            $report_params = $report->input_params;
            foreach($report_params as $param) {
                if (!array_key_exists($param, $parameters)) {
                    $msg = "Відсутній вхідний параметр '$param' для звіту '$report->name'";
                    throw new Exception($msg,500);
                }
            }
        */

        // Fetch report_snippets
        /*
            $snippets = ReportVariable::where('report_id', $report->id)->get();
        */
    }
}
