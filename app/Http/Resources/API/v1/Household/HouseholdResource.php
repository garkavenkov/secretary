<?php

namespace App\Http\Resources\API\v1\Household;

use App\Models\Household;
use App\Models\HouseholdType;
use App\Models\HouseholdHouse;
use App\Models\HouseholdMember;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\v1\Settlement\SettlementResource;
use App\Http\Resources\API\v1\HouseholdLand\HouseholdLandResource;
use App\Http\Resources\API\v1\HouseholdType\HouseholdTypeResource;
use App\Http\Resources\API\v1\HouseholdHouse\HouseholdHouseResource;
use App\Http\Resources\API\v1\HouseholdOwner\HouseholdOwnerResource;
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
            'number'                =>  (int)   $this->number,
            'household_number'      =>  $this->household_number,                    
            'settlement_id'         =>  (int)   $this->settlement_id,                
            'household_type_id'     =>  (int)   $this->household_type_id,                
            'household_type'        =>  $this->household_type,            
            'household_head'        =>  $this->household_head,
            'address'               =>  $this->address,
            'short_address'         =>  $this->short_address,            
            'full_address'          =>  $this->full_address,            
            'special_marks'         =>  $this->special_marks,
            'additional_data'       =>  $this->additional_data,
            'owners'                =>  HouseholdOwnerResource::collection($this->whenLoaded('owners'))
        ];
    }
  
}
