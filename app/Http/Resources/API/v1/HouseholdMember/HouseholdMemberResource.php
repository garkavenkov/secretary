<?php

namespace App\Http\Resources\API\v1\HouseholdMember;

use Illuminate\Http\Resources\Json\JsonResource;

class HouseholdMemberResource extends JsonResource
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
            'id'                        =>  (int)   $this->id,
            'household_id'              =>  (int)   $this->household_id,
            'surname'                   =>  $this->surname,
            'name'                      =>  $this->name,
            'patronymic'                =>  $this->patronymic,
            'sex'                       =>  $this->sex,
            'birthday'                  =>  $this->birthday,
            'family_relationship_id'    =>  (int)   $this->family_relationship_id,
            'employment_information'    =>  $this->employment_information,
            'place_work_id'             =>  (int)   $this->place_work_id,
        ];
    }
}
