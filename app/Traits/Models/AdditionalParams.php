<?php

namespace App\Traits\Models;

use App\Models\AdditionalParam;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\AdditionalParamValue;
use App\Models\AdditionalParamCategory;
use App\Models\AdditionalParamCondition;
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
        $params = AdditionalParam::query()
                        ->select('additional_params.*')
                        ->addSelect(DB::raw("
                                (
                                    select  count(*) 
                                    from    additional_param_conditions as cond 
                                    where   cond.param_id = additional_params.id
                                ) as conditions_count" )
                        )
                        ->join('additional_param_categories as apc', 'apc.id', '=', 'additional_params.category_id')                        
                        ->where('apc.code', get_class($this))                       
                        ->get();
        
        
        if (!is_null($filtered_params)) {

            if (!is_array($filtered_params)) {
                $filtered_params = explode(',',$filtered_params);
            }

            $params = $params->filter(function($param) use($filtered_params) {
                return Str::contains($param->code, $filtered_params);
            });
        }
        
        
        // Filter params that did not pass condition validation
        $result = $params->filter(function($param) {
            // if ($param->conditions()->count() == 0) {
            if($param->conditions_count == 0) {
                return $param;
            } else {
                // dd($param->conditions);
                $conditions = AdditionalParamCondition::query()
                                    ->from('additional_param_conditions as apc')
                                    ->select(
                                        'apc.id',
                                        'apc.condition',
                                        'apc.value',
                                        'ma.model',
                                        'ma.code',
                                        'ma.name',
                                        'ma.available_values' 
                                    )
                                    ->join('model_attributes as ma', 'apc.attribute_id','=', 'ma.id')
                                    ->where('apc.param_id', $param->id)
                                    ->get();
                // dd($conditions);
                // foreach($param->conditions as $condition) {
                foreach($conditions as $condition) {
                    // Get parameter's value                    
                    // $condition['code'] holds attribute in $this, 
                    // e.g $this['code'] contains model's field (property) value
                    $attr = $this[$condition['code']];
                    
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
     * @param AdditionalParam   Additional parameter
     * @param mixed $value      Additional parameter's value
     * @return AdditionalParamValue
     */
    public function setAdditionalParamValue(AdditionalParam $param, mixed $value): AdditionalParamValue
    {        
        $apv =  AdditionalParamValue::where('param_id', $param->id)->where('owner_id', $this->id)->first();

        if (!$apv) {
            return AdditionalParamValue::create([
                'owner_id' => $this->id,
                'param_id' => $param->id,
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
     * @param AdditionalParam   Additional parameter     
     * @return boolean|null
     */
    public function clearAdditionalParam(AdditionalParam $param): ?bool
    {
        $apv =  AdditionalParamValue::where('param_id', $param->id)->where('owner_id', $this->id)->first();
        if ($apv) {
            return ($apv->delete());
        } else {
            return null;
        }
    }
}
