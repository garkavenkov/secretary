<?php

namespace App\Http\Resources\API\v1\Household;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HouseholdResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($household) {
            return [
                'id'                    =>  (int)   $household->id,
                'community_id'          =>  (int)   $household->community_id,
                'household_type_id'     =>  (int)   $household->household_type_id,
                'address'               =>  $household->address,
                'special_marks'         =>  $household->special_marks,
                'additional_data'       =>  $household->additional_data
            ];
        });
    }
}
