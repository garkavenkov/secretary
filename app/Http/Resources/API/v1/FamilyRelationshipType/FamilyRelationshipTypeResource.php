<?php

namespace App\Http\Resources\API\v1\FamilyRelationshipType;

use Illuminate\Http\Resources\Json\JsonResource;

class FamilyRelationshipTypeResource extends JsonResource
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
            'id'    =>  (int)   $this->id,
            'name'  =>  $this->name,
            'sex'   =>  $this->sex,
        ];
    }
}
