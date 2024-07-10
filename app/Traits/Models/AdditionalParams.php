<?php

namespace App\Traits\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\AdditionalParamValue;
use App\Models\AdditionalParamCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

trait AdditionalParams
{

    /**
     * Get additional params for category.
     * Filter parameters if there is filtered_params was passed
     *
     * @param mixed $filtered_params    Parameters to be filtered
     * @return Collection
     */
    public function additionalParams(mixed $filtered_params = null): Collection
    {
        $category = AdditionalParamCategory::with('params.conditions')
                            ->where('code', get_class($this))
                            ->first();
        // dd($category);
        if (!$category) {
            return  null;
        }
        
        if (!is_null($filtered_params)) {

            if (!is_array($filtered_params)) {
                $filtered_params = explode(',',$filtered_params);
            }
            $params = $category->params->filter(function($param) use($filtered_params) {
                return Str::contains($param->code, $filtered_params);
            });

        } else {
            $params = $category->params;
        }
        
        // Filter params that did not pass condition validation
        $result = $params->filter(function($param) {
            if ($param->conditions()->count() == 0) {
                return $param;
            } else {
                foreach($param->conditions as $condition) {
                    //  Get parameter's value
                    $attr = $this[$condition['attribute']['code']];
                    //  Get condition's value
                    $value = $condition->value;

                    // Match values
                    $res[] = match ($condition->condition) {
                        '<'  => ($attr <  $value),
                        '<='  => ($attr <=  $value),
                        '==' => ($attr == $value),
                        '!=' => ($attr != $value),
                        '>' => ($attr > $value),
                        '>=' => ($attr >= $value),
                    };                                        
                }
                // Return true if all elements in the array are true;
                if ((bool) array_product($res)) {
                    return $param;
                }
            }
        });
        
        return $result;
    }

    // Why did I write this function?!.
    // Check if there is (are) call(s) from another place
    public function additionalParamsFilled()
    {
        
        $params = DB::table('additional_params as ap')
                    ->select('ap.id')
                    ->join('additional_param_categories as apc', 'ap.category_id', '=', 'apc.id')
                    ->where('apc.code', '=', get_class($this))        
                    ->pluck('id')
                    ->toArray();
        // dd($params);
        return $this->hasMany(AdditionalParamValue::class, 'owner_id')
                    ->where(function ($q) use($params) {
                        $q->whereIn('param_id', $params);
                    });
    }

    /**
     * Get additional parameters with values
     *
     * @param mixed $params     Parameters for filter
     * @return SupportCollection
     */
    public function additionalParamValue(mixed $params = null): SupportCollection
    {
        // Get additional params list.
        $param_ids = $this->additionalParams($params)->map(function($param) {
            return $param->id;
        })->toArray();
        
        $q = DB::table('additional_params as ap')
                ->select(                    
                    'ap.id as id',                                  // param_id
                    'ap.code as code',                              // param_code
                    'ap.name as name',                              // param_name
                    'apvt.code as value_type_code',                 // value_type_code
                    'apvt.name as value_type_name',                 // value_type_name
                    'apvt.description as value_type_description',   // value_type_description
                    'ap.is_system as is_system',                    // is_system
                    'apv.value as value'                            // value
                )
                ->join('additional_param_categories as apc', 'apc.id', '=', 'ap.category_id')
                ->join('additional_param_value_types as apvt', 'apvt.id', '=', 'ap.value_type_id')
                ->leftJoin('additional_param_values as apv', function($join) {
                    $join->on('apv.param_id', '=', 'ap.id')
                        ->where('apv.owner_id', $this->id);
                })                
                ->whereIn('ap.id', array_values($param_ids));

        //  This part is already checked in additionalParams()
        //  Need to remove 
        /*
         if (isset($params)) {
            if (is_array($params)) {
                $q = $q->whereIn('ap.code', $params);
            } else {
                $q = $q->where('ap.code', 'like', $params);
            }
        }
        */        
        
        return $q->orderBy('ap.code')->get();
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

    /**
     * Set value for additional parameter
     *
     * @param integer $param_id     Additional parameter's id
     * @param mixed $value          Additional parameter's value
     * @return AdditionalParamValue
     */
    public function setAdditionalParamValue(int $param_id, mixed $value): AdditionalParamValue
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
    
    /**
     * Remove additional parameter's value
     *
     * @param integer $id   Additional parameter value's ID
     * @return boolean|null
     */
    public function clearAdditionalParam(int $id): ?bool
    {
        $apv =  AdditionalParamValue::where('param_id', $id)->where('owner_id', $this->id)->first();
        if ($apv) {
            return ($apv->delete());
        } else {
            return null;
        }
    }
}
