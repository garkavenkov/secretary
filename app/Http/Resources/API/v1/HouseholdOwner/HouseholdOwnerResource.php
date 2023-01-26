<?php

namespace App\Http\Resources\API\v1\HouseholdOwner;

use Illuminate\Http\Resources\Json\JsonResource;

class HouseholdOwnerResource extends JsonResource
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
            'id'            =>  (int)   $this->id,
            'household_id'  =>  (int)   $this->household_id,
            'name'          =>  $this->name,
            'address'       =>  $this->address
        ];
    }
}
