<?php

namespace App\Http\Resources\API\v1\HouseholdHouse;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HouseholdHouseResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($info) {
            return [
                'id'                    =>  (int)   $info->id,
                'household_id'          =>  (int)   $info->household_id,
                'year'                  =>  (int)   $info->year,
                'total_area'            =>  (float) $info->total_area,
                'total_living_area'     =>  (float) $info->total_living_area,
                'living_area'           =>  (float) $info->living_area,
                'room_count'            =>  (int)   $info->room_count,
                'total_non_living_area' =>  (float) $info->total_non_living_area,
                'water_supply'          =>  (bool)  $info->water_supply,
                'hot_water_supply'      =>  (bool)  $info->hot_water_supply,
                'sewage'                =>  (bool)  $info->sewage,
                'central_heating'       =>  (bool)  $info->central_heating,
                'individual_heating'    =>  (bool)  $info->individual_heating,
                'furnace_heating'       =>  (bool)  $info->furnace_heating,
                'natural_gas'           =>  (bool)  $info->natural_gas,
                'liquefied_gas'         =>  (bool)  $info->liquefied_gas,
                'electric_stove'        =>  (bool)  $info->electric_stove
            ];
        });
    }
}
