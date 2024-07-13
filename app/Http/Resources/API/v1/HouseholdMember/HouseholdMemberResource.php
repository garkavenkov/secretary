<?php

namespace App\Http\Resources\API\v1\HouseholdMember;

use App\Models\Household;
use App\Models\HouseholdMemberLand;
use function PHPUnit\Framework\isNull;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\v1\WorkPlace\WorkPlaceResource;
use App\Http\Resources\API\v1\HouseholdMemberLand\HouseholdMemberLandResource;

use App\Http\Resources\API\v1\AdditionalParamValue\AdditionalParamValueResource;
use App\Http\Resources\API\v1\HouseholdMemberMovement\HouseholdMemberMovementResource;

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
            'id'                            =>  (int)   $this->id,
            'household_id'                  =>  (int)   $this->household_id,
            'surname'                       =>  $this->surname,
            'name'                          =>  $this->name,
            'patronymic'                    =>  $this->patronymic,
            'full_name'                     =>  $this->full_name,
            'sex'                           =>  $this->sex,
            'birthdate'                     =>  $this->birthdate,
            'family_relationship_type_id'   =>  (int)   $this->family_relationship_type_id,
            'full_age'                      =>  (int)   $this->full_age,            
            'family_relationship_type'      =>  $this->family_relationship_type,
            'employment_information'        =>  $this->employment_information,
            'social_information'            =>  $this->social_information,
            'additional_information'        =>  $this->additional_information,
            'work_place_id'                 =>  (int)   $this->work_place_id,            
            'work_place'                    =>  $this->work_place,
            'status'                        =>  $this->status,
            'death_date'                    =>  $this->death_date,
            'death_register_number'         =>  $this->death_register_number,
            'death_register_office'         =>  $this->death_register_office,
            'household_number'              =>  Household::getHouseholdNumber(
                                                        $this->settlement_inner_code, 
                                                        $this->number, 
                                                        $this->household_type_id
                                                ),
            'full_address'                  =>  Household::getFullAddress(
                                                        $this->address,
                                                        $this->settlement, 
                                                        $this->settlement_type, 
                                                        $this->district, 
                                                        $this->region
                                                )            
            // 'relatives'                     =>  $this->relatives()
        ];
    }
}
