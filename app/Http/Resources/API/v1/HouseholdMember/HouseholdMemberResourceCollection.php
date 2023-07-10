<?php

namespace App\Http\Resources\API\v1\HouseholdMember;

use Carbon\Carbon;
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
                'full_name'                 =>  $member->full_name,
                'sex'                       =>  $member->sex,
                'birthdate'                 =>  $member->birthdate,
                'birthdate_formatted'       =>  Carbon::parse($member->birthdate)->format('d.m.Y'),
                'family_relationship_type'  =>  $member->whenLoaded('familyRelationshipType', $member->familyRelationshipType->name),
                // 'employment_information'    =>  $member->employment_information,
                // 'work_place'                =>  new WorkPlaceResource($member->whenLoaded('workPlace')),
                'status'                    =>  $member->status,
                'death_date'                =>  $member->death_date,
                'relatives'                 =>  $member->relatives(),
                'address'                   =>  $member->whenLoaded('household', $member->household->getFullAddress()),
                'household_number'          =>  $member->whenLoaded('household', $member->household->fullNumber()),
                // 'household'                 =>  $member->whenLoaded('household', $member->household),
                // 'death_register_number'     =>  $member->death_register_number,
                // 'death_register_office'     =>  $member->death_register_office,
            ];
        });
    }
}
