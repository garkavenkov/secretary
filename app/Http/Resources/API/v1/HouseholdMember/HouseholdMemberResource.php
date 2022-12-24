<?php

namespace App\Http\Resources\API\v1\HouseholdMember;


use App\Http\Resources\API\v1\WorkPlace\WorkPlaceResource;
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
            'family_relationship'       =>  $this->when('familyRelationship', $this->familyRelationship->name),
            'employment_information'    =>  $this->employment_information,
            'work_place_id'             =>  (int)   $this->work_place_id,
            // 'work_place'                =>  $this->whenLoaded('workPlace', $this->workPlace->name),
            'work_place'                =>  new WorkPlaceResource($this->whenLoaded('workPlace'))
        ];
    }
}
