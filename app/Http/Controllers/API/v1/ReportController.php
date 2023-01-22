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
        $report = 'membersByAge';
        // echo (int) method_exists($this, $report);
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
}
