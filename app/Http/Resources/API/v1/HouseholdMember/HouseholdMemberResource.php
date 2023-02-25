<?php

namespace App\Http\Resources\API\v1\HouseholdMember;

use App\Http\Resources\API\v1\AdditionalParamValue\AdditionalParamValueResource;
use App\Http\Resources\API\v1\HouseholdMemberLand\HouseholdMemberLandResource;
use App\Http\Resources\API\v1\HouseholdMemberMovement\HouseholdMemberMovementResource;
use App\Http\Resources\API\v1\WorkPlace\WorkPlaceResource;
use App\Models\HouseholdMemberLand;
use Illuminate\Http\Resources\Json\JsonResource;

use function PHPUnit\Framework\isNull;

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
            'family_relationship_type'      =>  $this->whenLoaded('familyRelationshipType', $this->familyRelationshipType->name),
            'employment_information'        =>  $this->employment_information,
            'social_information'            =>  $this->social_information,
            'additional_information'        =>  $this->additional_information,
            'work_place_id'                 =>  (int)   $this->work_place_id,
            'work_place'                    =>  new WorkPlaceResource($this->whenLoaded('workPlace')),
            'movements'                     =>  HouseholdMemberMovementResource::collection($this->whenLoaded('movements')),
            'status'                        =>  $this->status,
            'death_date'                    =>  $this->death_date,
            'death_register_number'         =>  $this->death_register_number,
            'death_register_office'         =>  $this->death_register_office,
            'land'                          =>  HouseholdMemberLandResource::collection($this->whenLoaded('land')),
            // 'land_owned'                    =>  (float) $this->land_owned,
            // 'land_rented'                   =>  (float) $this->land_rented,
            // 'land_leased'                   =>  (float) $this->land_leased,
            'additional_params'             =>  AdditionalParamValueResource::collection($this->memberInfo()),
        ];
    }
}
