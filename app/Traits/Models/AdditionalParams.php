<?php

namespace App\Traits\Models;

use Illuminate\Support\Facades\DB;
use App\Models\AdditionalParamValue;
use App\Models\AdditionalParamCategory;

trait AdditionalParams
{
    public function additionalParams($params)
    {
        $category = AdditionalParamCategory::where('code', get_class($this))->first();

        return $category->params($params);
    }

    public function additionalParamValue($params = null)
    {
        $q = DB::table('additional_params as ap')
                ->select(
                    // 'ap.id as param_id',  // id
                    // 'ap.code as param_code',   // code
                    // 'ap.name as param_name',   // name
                    // 'apvt.code as param_type_code',    //value_type_code
                    // 'apvt.name as param_type_name',    //value_type_name
                    // 'apvt.description as param_type_description', //value_type_description
                    // 'ap.is_system as param_system',        // is_system
                    // 'apv.value as param_value'             // value
                    'ap.id as id',  // id
                    'ap.code as code',   // code
                    'ap.name as name',   // name
                    'apvt.code as value_type_code',    //value_type_code
                    'apvt.name as value_type_name',    //value_type_name
                    'apvt.description as value_type_description', //value_type_description
                    'ap.is_system as is_system',        // is_system
                    'apv.value as value'             // value
                )
                ->join('additional_param_categories as apc', 'apc.id', '=', 'ap.category_id')
                ->join('additional_param_value_types as apvt', 'apvt.id', '=', 'ap.value_type_id')
                ->leftJoin('additional_param_values as apv', function($join) {
                    $join->on('apv.param_id', '=', 'ap.id')
                        ->where('apv.owner_id', $this->id);
                })
                ->where('apc.code', get_class($this));

        if (isset($params)) {
            if (is_array($params)) {
                $q = $q->whereIn('ap.code', $params);
            } else {
                $q = $q->where('ap.code', 'like', $params);
            }
        }
                // ->whereIn('ap.code', $params)
        return $q->orderBy('ap.id')->get();
    }

    // ??? not sure if this method will be needed.
    public function getAdditionalParam($param)
    {
        return DB::table('additional_params as ap')
                ->select('ap.*')
                ->join('additional_param_categories as apc', 'apc.id', '=', 'ap.category_id')
                ->where('apc.code', get_class($this))
                ->where('ap.code', $param)
                ->first();
    }

    public function setAdditionalParamValue($param_id, $value)
    {
        $apv =  AdditionalParamValue::where('param_id', $param_id)->where('owner_id', $this->id)->first();

        if (!$apv) {
            return AdditionalParamValue::create([
                'owner_id' => $this->id,
                'param_id' => $param_id,
                'value' => $value
            ]);
        } else {
            if ($apv->value !== $value) {
                $apv->value = $value;
                $apv->save();
            }
        }
        return $apv;
    }

    public function clearAdditionalParam($id)
    {
        $apv =  AdditionalParamValue::where('param_id', $id)->where('owner_id', $this->id)->first();
        if ($apv) {
            return ($apv->delete());
        } else {
            return null;
        }
    }
}
