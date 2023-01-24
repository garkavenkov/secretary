<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Settlement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;

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

        if (isset($params['settlement'])) {
            $settlment_id = $params['settlement'];
        } else {
            $settlments = Settlement::find([1,2]);
        }

        if (isset($params['date'])) {
            $date = $params['date'];
        }

        if (isset($params['sex']) && ($params['sex'] != 0)) {
            $sex = $params['sex'];
        }

        $result = [];

        $settlments->each(function($s) use($sex, $date , &$result) {
            $members = $s->membersByAge(sex: $sex, date: $date);

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

        if (isset($params['settlement'])) {
            $settlment_id = $params['settlement'];
        } else {
            $settlments = Settlement::find([1,2]);
        }

        if (isset($params['date'])) {
            $date = $params['date'];
        }

        $result = [];

        $settlments->each(function($s) use($date, &$result) {
            $res = [];
            $res['settlement'] = $s->name;
            $res['households_total']   = $s->households->count();
            $res['households_living']  = $s->households([1,2])->count();

            $members_active     = $s->activeMembers($date);
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

            $result[] = $res;
        });

        return $result;
    }
}
