<?php

namespace App\Http\Resources\API\v1\AdditionalParamCategory;

use App\Http\Resources\API\v1\AdditionalParam\AdditionalParamResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AdditionalParamCategoryResource extends JsonResource
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
            'id'        =>  (int)   $this->id,
            'code'      =>  $this->code,
            'name'      =>  $this->name,
            'params'    =>  AdditionalParamResource::collection($this->whenLoaded('params')),
        ];
    }
}
