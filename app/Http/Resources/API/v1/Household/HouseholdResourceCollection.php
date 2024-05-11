<?php

namespace App\Http\Resources\API\v1\Household;

use App\Http\Resources\API\v1\Settlement\SettlementResource;
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
                'id'                        =>  (int)   $household->id,
                'settlement_id'             =>  (int)   $household->settlement_id,
                // 'settlement'                =>  $household->whenLoaded('settlement', function() use($household) {
                //                                     return $household->settlement->name;
                //                                 }),
                'settlement'                =>  $household->whenLoaded('settlement', $household->settlement->name),
                'household_type_id'         =>  (int)   $household->household_type_id,
                'number'                    =>  $household->fullNumber(),
                'raw_address'               =>  $household->address,
                'short_address'             =>  $household->getShortAddress(),
                'household_head'            =>  $household->household_head(),
                'household_members_count'   =>  $household->members()->alive()->count()
                // 'special_marks'         =>  $household->special_marks,
                // 'additional_data'       =>  $household->additional_data
            ];
        });
    }
}
