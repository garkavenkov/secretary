<?php

namespace App\Http\Resources\API\v1\Household;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'community_id'          =>  (int)   $this->community_id,
            'household_type_id'     =>  (int)   $this->household_type_id,
            'address'               =>  $this->address,
            'special_marks'         =>  $this->special_marks,
            'additional_data'       =>  $this->additional_data
        ];
    }
}
