<?php

namespace App\Http\Resources\API\v1\Household;

use App\Models\HouseholdType;
use App\Models\HouseholdHouse;
use App\Models\HouseholdMember;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\v1\Settlement\SettlementResource;
use App\Http\Resources\API\v1\HouseholdLand\HouseholdLandResource;
use App\Http\Resources\API\v1\HouseholdType\HouseholdTypeResource;
use App\Http\Resources\API\v1\HouseholdHouse\HouseholdHouseResource;
use App\Http\Resources\API\v1\HouseholdMember\HouseholdMemberResource;
use App\Http\Resources\API\v1\AdditionalParamValue\AdditionalParamValueResource;
use App\Http\Resources\API\v1\HouseholdMember\HouseholdMemberResourceCollection;

class HouseholdResource extends JsonResource
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
            'number'                =>  $this->fullNumber(),
            'info'                  =>  [
                'settlement_id'         =>  (int)   $this->settlement_id,
                'settlement'            =>  new SettlementResource($this->whenLoaded('settlement')),
                'household_type_id'     =>  (int)   $this->household_type_id,
                // 'household_type'        =>  new HouseholdTypeResource($this->whenLoaded('type')),
                'household_type'        =>  $this->whenLoaded('type', $this->type->name),
                'number'                =>  (int)   $this->number,
                'household_head'        =>  $this->household_head(),
                'raw_address'           =>  $this->address,
                'address'               =>  $this->getAddress(),
                'full_address'          =>  $this->getFullAddress(),                
                'special_marks'         =>  $this->special_marks,
                'additional_data'       =>  $this->additional_data,
                'owners'                =>  $this->owners,
            ],
            // 'members'               =>  $members,
            // 'houseYears'            =>  HouseholdHouseResource::collection($this->whenLoaded('houseYears')),
            'houseInfo'             =>  $this->houseInfo(),
            // 'landYears'             =>  HouseholdLandResource::collection($this->whenLoaded('landYears')),
            'landInfo'              =>  $this->landInfo(),
            'familyInfo'            =>  AdditionalParamValueResource::collection($this->familyInfo()),
        ];
    }
}
