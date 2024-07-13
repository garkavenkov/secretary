<?php

namespace App\Http\Resources\API\v1\HouseholdMember;

use App\Models\Household;
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
                'full_age'                  =>  $member->full_age,
                'family_relationship_type'  =>  $member->family_relationship_type,
                'status'                    =>  $member->status,
                'death_date'                =>  $member->death_date,
                'full_address'              =>  Household::getFullAddress(
                                                        $member->address,
                                                        $member->settlement, 
                                                        $member->settlement_type, 
                                                        $member->district, 
                                                        $member->region
                                                ),
                'household_number'          =>  Household::getHouseholdNumber(
                                                    $member->settlement_inner_code, 
                                                    $member->number, 
                                                    $member->household_type_id
                                                ),
                // 'relatives'                 =>  $member->relatives()
                'relatives'                 =>  []
            ];
        });
    }
}
