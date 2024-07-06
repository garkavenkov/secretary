<?php

namespace App\Http\Resources\API\v1\AdditionalParam;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\v1\AdditionalParamCategory\AdditionalParamCategoryResource;
use App\Http\Resources\API\v1\AdditionalParamCondition\AdditionalParamConditionResource;
use App\Http\Resources\API\v1\AdditionalParamValueType\AdditionalParamValueTypeResource;

class AdditionalParamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            =>  (int)   $this->id,
            'category_id'   =>  (int)   $this->category_id,
            'category'      =>  new AdditionalParamCategoryResource($this->whenLoaded('category')),
            'code'          =>  $this->code,
            'name'          =>  $this->name,
            'value_type_id' =>  (int)   $this->value_type_id,
            'value_type'    =>  new AdditionalParamValueTypeResource($this->whenLoaded('valueType')),
            'conditions'    =>  AdditionalParamConditionResource::collection($this->whenLoaded('conditions')),
            'is_system'     =>  (bool)  $this->is_system
        ];
    }
}
