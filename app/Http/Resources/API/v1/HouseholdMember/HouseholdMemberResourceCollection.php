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
                'full_age'                  =>  $member->fullAge,
                'family_relationship_type'  =>  $member->whenLoaded('familyRelationshipType', $member->familyRelationshipType->name),
                'status'                    =>  $member->status,
                'death_date'                =>  $member->death_date,
                'address'                   =>  $member->whenLoaded('household', $member->household->getFullAddress()),
                'household_number'          =>  $member->whenLoaded('household', $member->household->fullNumber()),
                // 'relatives'                 =>  $member->relatives()
            ];
        });
    }
}
