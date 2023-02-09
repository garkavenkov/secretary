<?php

namespace App\Http\Resources\API\v1\AdditionalParamValue;

use Illuminate\Http\Resources\Json\JsonResource;

class AdditionalParamValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $value = '';

        switch ($this->value_type_code) {
            case 'boolean':
                $value = boolval($this->value);
                break;
            default:
               $value = $this->value;
        }

        return [
            // 'param_id'          =>  (int)   $this->param_id,
            // 'param_code'        =>  $this->param_code,
            // 'param_name'        =>  $this->param_name,
            // 'param_is_system'   =>  (bool)  $this->param_system,
            // 'param_value'       =>  (bool)  $this->param_value
            'id'                        =>  (int)   $this->id,
            'code'                      =>  $this->code,
            'name'                      =>  $this->name,
            'is_system'                 =>  (bool)  $this->is_system,
            'value'                     =>  $value,
            'value_type_code'           =>  $this->value_type_code,
            'value_type_name'           =>  $this->value_type_name,
            'value_type_description'    =>  $this->value_type_description,
        ];
    }
}
