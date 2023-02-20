<?php

namespace App\Http\Resources\API\v1\HouseholdMemberLand;

use Illuminate\Http\Resources\Json\JsonResource;

class HouseholdMemberLandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $total =    $this->maintenance +
                    $this->personal_agriculture +
                    $this->land_share +
                    $this->property_share +
                    $this->hay_cutting +
                    $this->pastures;
        return [
            'id'                        =>  (int)   $this->id,
            'member_id'                 =>  (int)   $this->member_id,
            'year'                      =>  (int)   $this->year,
            'total'                     =>  number_format($total, 4),
            'maintenance'               =>  number_format($this->maintenance, 4),
            'personal_agriculture'      =>  number_format($this->personal_agriculture, 4),
            'land_share'                =>  number_format($this->land_share, 4),
            'property_share'            =>  number_format($this->property_share, 4),
            'hay_cutting'               =>  number_format($this->hay_cutting, 4),
            'pastures'                  =>  number_format($this->pastures, 4),
        ];
    }
}
