<?php

namespace App\Http\Resources\API\v1\HouseholdMember;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HouseholdMemberResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($member) {
            return [
                'id'                        =>  (int)   $member->id,
                'household_id'              =>  (int)   $member->household_id,
                'surname'                   =>  $member->surname,
                'name'                      =>  $member->name,
                'patronymic'                =>  $member->patronymic,
                'sex'                       =>  $member->sex,
                'birthdate'                 =>  $member->birthdate,
                'family_relationship'       =>  $member->whenLoaded('familyRelationship', $member->familyRelationship->name),
                // 'employment_information'    =>  $member->employment_information,
                // 'work_place'                =>  new WorkPlaceResource($member->whenLoaded('workPlace')),
                'status'                    =>  $member->status,
                'death_date'                =>  $member->death_date,
                // 'death_register_number'     =>  $member->death_register_number,
                // 'death_register_office'     =>  $member->death_register_office,
            ];
        });
    }
}
