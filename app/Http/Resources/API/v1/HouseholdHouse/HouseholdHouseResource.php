<?php

namespace App\Http\Resources\API\v1\HouseholdHouse;

use Illuminate\Http\Resources\Json\JsonResource;

class HouseholdHouseResource extends JsonResource
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
            'household_id'          =>  (int)   $this->household_id,
            'year'                  =>  (int)   $this->year,
            'total_area'            =>  (float) $this->total_area,
            'total_living_area'     =>  (float) $this->total_living_area,
            'living_area'           =>  (float) $this->living_area,
            'room_count'            =>  (int)   $this->room_count,
            'total_non_living_area' =>  (float) $this->total_non_living_area,
            'water_supply'          =>  (bool)  $this->water_supply,
            'hot_water_supply'      =>  (bool)  $this->hot_water_supply,
            'sewage'                =>  (bool)  $this->sewage,
            'central_heating'       =>  (bool)  $this->central_heating,
            'individual_heating'    =>  (bool)  $this->individual_heating,
            'furnace_heating'       =>  (bool)  $this->furnace_heating,
            'natural_gas'           =>  (bool)  $this->natural_gas,
            'liquefied_gas'         =>  (bool)  $this->liquefied_gas,
            'electric_stove'        =>  (bool)  $this->electric_stove
        ];
    }
}
