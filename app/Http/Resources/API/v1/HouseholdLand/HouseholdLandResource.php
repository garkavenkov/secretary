<?php

namespace App\Http\Resources\API\v1\HouseholdLand;

use Illuminate\Http\Resources\Json\JsonResource;

class HouseholdLandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $total = $this->maintenance + $this->personal_agriculture + $this->commercial_agriculture;
        return [
            'id'                        =>  (int)   $this->id,
            'household_id'              =>  (int)   $this->household_id,
            'year'                      =>  (int)   $this->year,
            'total'                     =>  (float) $total,
            // 'purpose'                   =>  (float) $this->purpose,
            'maintenance'               =>  (float) $this->maintenance,
            'personal_agriculture'      =>  $this->personal_agriculture,
            'commercial_agriculture'    =>  $this->commercial_agriculture,
            // 'arable'                    =>  (float) $this->arable,
            // 'perennial_plantations'     =>  (float) $this->perennial_plantations,
            // 'pastures'                  =>  (float) $this->pastures,
        ];
    }
}
