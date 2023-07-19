<?php

namespace App\Http\Resources\API\v1\HouseholdMember;

use Illuminate\Http\Resources\Json\JsonResource;

class HouseholdMemberRelativesResource extends JsonResource
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
            'surname'       =>  $this->surname,
            'name'          =>  $this->name,
            'patronymic'    =>  $this->patronymic,
            'fullName'      =>  $this->full_name,
            'relatives'     =>  $this->relatives()
        ];
    }
}
