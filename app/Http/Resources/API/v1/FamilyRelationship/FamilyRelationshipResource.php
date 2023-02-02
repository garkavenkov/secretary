<?php

namespace App\Http\Resources\API\v1\FamilyRelationship;

use Illuminate\Http\Resources\Json\JsonResource;

class FamilyRelationshipResource extends JsonResource
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
            'id'                    =>  (int)   $this->id,
            'member_id'             =>  (int)   $this->member_id,
            'relationship_type_id'  =>  (int)   $this->relationship_type_id,
            'relative_id'           =>  (int)   $this->relative_id,
        ];
    }
}
