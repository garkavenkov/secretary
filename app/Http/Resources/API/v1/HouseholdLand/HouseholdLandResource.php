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
            'total'                     =>  number_format($total, 3),
            // 'purpose'                   =>  (float) $this->purpose,
            'maintenance'               =>  number_format($this->maintenance, 3),
            'personal_agriculture'      =>  number_format($this->personal_agriculture, 3),
            'commercial_agriculture'    =>  number_format($this->commercial_agriculture, 3),
            // 'arable'                    =>  (float) $this->arable,
            // 'perennial_plantations'     =>  (float) $this->perennial_plantations,
            // 'pastures'                  =>  (float) $this->pastures,
        ];
    }
}
