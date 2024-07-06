<?php

namespace App\Http\Resources\API\v1\AdditionalParamCondition;

use App\Http\Resources\API\v1\ModelAttribute\ModelAttributeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AdditionalParamConditionResource extends JsonResource
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
            'id'            =>  (int) $this->id,
            'param_id'      =>  (int) $this->param_id,
            'attribute_id'  =>  $this->attribute_id,
            'attribute'     =>  new ModelAttributeResource($this->whenLoaded('attribute')),
            'condition'     =>  $this->condition,
            'value'         =>  $this->value
        ];
    }
}
