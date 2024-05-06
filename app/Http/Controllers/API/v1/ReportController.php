<?php

namespace App\Http\Controllers\API\v1;

use Exception;
use App\Models\Settlement;
use Illuminate\Http\Request;
use App\Models\HouseholdMember;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\v1\Report\ReportResource;
// use App\Models\HouseholdMemberLand;
use App\Models\Report;

use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpKernel\Exception\HttpException;
use ZipArchive;

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
        $reports = Report::all();
        
        return ReportResource::collection($reports);
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
        $report = Report::findOrFail($id);

        return new ReportResource($report);
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
        
        if(!isset($params['member_id'])) {
            throw new Exception('Member did not pass');
        }

        $ids = explode(',', $params['member_id']);
        $members = HouseholdMember::findOrFail($ids);
        
        $reports = [];

        foreach($members as $member) {

         // Make function for checking report template
            try {
                $templateProcessor = new TemplateProcessor(storage_path('app/documents/FamilyComposition.docx'));
            } catch (Exception $e) {
                $msg = 'Шаблон звіту FamilyComposition.docx не знайден. Завантажіть шаблон';
                throw new Exception($msg,500);
            }        
            
            $person_pronoun =  $member->sex == 'жіноча' ? 'нею' : 'ним';
            
            if (isset($params['relatives'])) {
                $relatives_ids = explode(',', $params['relatives']);
    
                $relatives = $member->relatives()->filter(function($r) use($relatives_ids) {
                    return in_array($r->id, $relatives_ids);
                });
    
            } else {
                $relatives = $member->relatives();
            }
            
            $templateProcessor->setValue('person_pronoun', $person_pronoun);
            $templateProcessor->setValue('person_name', $member->full_name);
            $templateProcessor->setValue('person_birthdate', $member->formatted_birthdate);
            $templateProcessor->setValue('person_address_registration', $member->registration_address);
            
            $rels = [];

            foreach($relatives as $relative) {
                $rel['relative'] =  "$relative->relation - $relative->full_name, $relative->formatted_birthdate р.н.,";
                $rels[] = $rel;
            }

            $templateProcessor->cloneBlock('relatives', 0, true, false, $rels);
            
            $filename = str_replace(' ', '_', $member->full_name).".docx";
            $templateProcessor->saveAs(storage_path($filename));
            $reports[] = $filename;            
        }
        
        $this->prepareForDownload(reports: $reports, archive: 'familyComposition');      

    }

    private function prepareForDownload(array $reports, string $archive)
    {
        if (count($reports) > 1) {

            $zip = new ZipArchive();
            
            $archive = "$archive.zip";
    
            if ($zip->open(storage_path($archive), ZipArchive::CREATE)!==TRUE) {
                throw new Exception("Cannot open $archive.zip",500);
            } else {
                foreach($reports as $report) {
                    $zip->addFile(storage_path($report), $report);        
                }
                $zip->close();
    
                foreach($reports as $report) {
                    unlink(storage_path($report));
                }
                $this->downloadFile(content_type: "application/zip", filename: $archive);
                
            }

        } else if (count($reports) == 1 ) {
            $filename = $reports[0];
            $this->downloadFile(content_type: "application/vnd.openxmlformats-officedocument.wordprocessingml.document;charset=utf-8", filename: $filename);
            
        }
    }

    private function downloadFile(string $filename, string $content_type)
    {  
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Length: " . filesize(storage_path($filename)));
        readfile(storage_path($filename));
        unlink(storage_path($filename));
        exit;
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

        $ids = explode(',', $params['member_id']);
        $members = HouseholdMember::findOrFail($ids);
        
        $reports = [];

        foreach($members as $member) {

            $year = $member->landYear($params['year']);
            
            if (is_null($year)) {

                if (count($members) == 1) {
                    throw new Exception("Інформація за ". $params['year'] . " відсутня", 404);
                }

            } else {

                try {
                    $templateProcessor = new TemplateProcessor(storage_path('app/documents/LandOwned.docx'));
                } catch (Exception $e) {
                    $msg = 'Шаблон звіту LandOwned.docx не знайден. Завантажіть шаблон';
                    throw new Exception($msg,500);
                }

                $templateProcessor->setValue('person_name',                 $member->full_name_in_dative);
                $templateProcessor->setValue('person_birthdate',            $member->formatted_birthdate);
                $templateProcessor->setValue('person_address_registration', $member->registration_address);
                $templateProcessor->setValue('land_year',                   $params['year']);
                $templateProcessor->setValue('land_total',                  $year->formatted_total);
                $templateProcessor->setValue('land_maintenance',            $year->formatted_maintenance);
                $templateProcessor->setValue('land_personal_agriculture',   $year->formatted_personal_agriculture);
                $templateProcessor->setValue('land_share',                  $year->formatted_land_share);
                $templateProcessor->setValue('land_property_share',         $year->formatted_property_share);
                $templateProcessor->setValue('land_hay_cutting',            $year->formatted_hay_cutting);
                $templateProcessor->setValue('land_pastures',               $year->formatted_hay_cutting);

                $filename = str_replace(' ', '_', $member->full_name).".docx";
                $templateProcessor->saveAs(storage_path($filename));
                $reports[] = $filename;

            }

        }

        $this->prepareForDownload(reports: $reports, archive: 'landOwned');
        
      
    }

    protected function formatTemplateValue($value, $suffix = '', $default = '')
    {
        if ($default !== '') {
            if ($value == 0 || $value == '' || !$value || $value == 'false') {
                return $default.$suffix;
            }
        }
        return $value.$suffix;
    }

    public function generateReport(Request $request)
    {
        if (!isset($request->report)) {
            return response()->json(['message' => 'Report did not pass'], 404);
        }

        // Income parameters:
        $report_code = $request->report;        

        // Check whether report exists in DB;
        $report = Report::where('code', $report_code)->first();        
        
        if (!$report) {
            $msg = "Договір '$report->name' відсутній в системі. Зверниться до довідника дороворів.";
            throw new Exception($msg,500);
        }
        
        // Check id report's template exists
        if (!Storage::disk('local')->exists("documents/LandOwned.docx")) {
            // $templateProcessor = new TemplateProcessor(storage_path('app/documents/$report->file_name'));
            $msg = "Шаблон документа '$report->file_name' для документу '$report->name' не знайден.<br>Завантажіть шаблон документа";
            throw new Exception($msg,500);
        } 
        

        $report_params = [
            // 'land_owned'    => [
                'member_id' =>  [
                    'type'  => 'key',
                    'model' => 'App\Models\HouseholdMember',
                    'required'  =>  true,
                    'multiple'  =>  true,
                ],
                'year'  =>  [
                    'type'  => 'property',
                    'model' =>  'App\Models\HouseholdMember',
                    'required'  =>  true,
                    'multiple'  =>  false,
                ]
            // ]        
        ];
        /*

            $entity = $model::findOrFail($member_id);

        */


        $report_params_keys = array_keys($report_params);
        dd($request->all(), $report_params_keys);
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

        /*
            $template_variables = [
                'person_name'                   =>  [model => 'App\Models\HouseholdMember', property => 'full_name_id_dative'],
                'person_birthdate',             =>  [model => 'App\Models\HouseholdMember', property => 'formatted_birthdate'],
                'person_address_registration',  =>  [model => 'App\Models\HouseholdMember', property => 'person_address_registration'],
                'land_year',                    =>  
                'land_total',
                'land_maintenance', 
                'land_personal_agriculture',
                'land_share',
                'land_property_share',
                'land_hay_cutting',
                'land_pastures'
            ];

            $templateProcessor->setValue('person_name',                 $member->full_name_in_dative);
            $templateProcessor->setValue('person_birthdate',            $member->formatted_birthdate);
            $templateProcessor->setValue('person_address_registration', $member->registration_address);
            $templateProcessor->setValue('land_year',                   $params['year']);
            $templateProcessor->setValue('land_total',                  $year->formatted_total);
            $templateProcessor->setValue('land_maintenance',            $year->formatted_maintenance);
            $templateProcessor->setValue('land_personal_agriculture',   $year->formatted_personal_agriculture);
            $templateProcessor->setValue('land_share',                  $year->formatted_land_share);
            $templateProcessor->setValue('land_property_share',         $year->formatted_property_share);
            $templateProcessor->setValue('land_hay_cutting',            $year->formatted_hay_cutting);
            $templateProcessor->setValue('land_pastures',               $year->formatted_hay_cutting);
        */


        // Fetch report_snippets
        /*
            $snippets = ReportVariable::where('report_id', $report->id)->get();
        */

        // Replace template variables with values
        /*
        foreach($parsedTempateVariable as $variable => $value) {
            $templateProcessor->setValue($variable, $value);
        }
        */
    }

    public function downloadReportTemplate($id)
    {
        // $report = Report::findOrFail($id);
        $report = 'FamilyComposition.docx';
        // dd(file_exists(storage_path("app/documents/$report")));
        // return Storage::download(storage_path("app/documents/$report"));
        return response()->download(storage_path("app/documents/$report"));
        // header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document;charset=utf-8");
        // header("Content-Disposition: attachment; filename=$report");
        // header("Content-Length: " . filesize(storage_path($report)));
        // readfile(storage_path($report));
        // exit;
    }
}
