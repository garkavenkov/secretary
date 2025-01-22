<?php

namespace App\Http\Resources\API\v1\Household;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\v1\HouseholdOwner\HouseholdOwnerResource;

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
            'household_head'        =>  $this->head,
            'address'               =>  $this->address,
            'short_address'         =>  $this->short_address,   // attribute         
            'full_address'          =>  $this->full_address,    // attribute        
            'special_marks'         =>  $this->special_marks,
            'additional_data'       =>  $this->additional_data,
            'owners'                =>  HouseholdOwnerResource::collection($this->whenLoaded('owners'))
        ];
    }
  
}
