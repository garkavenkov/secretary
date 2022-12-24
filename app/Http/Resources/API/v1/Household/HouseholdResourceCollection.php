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
                'id'                    =>  (int)   $household->id,
                'settlement_id'         =>  (int)   $household->settlement_id,
                // 'settlement'            =>  new SettlementResource($household->whenLoaded('settlement')),
                'settlement'            =>  $household->whenLoaded('settlement', function() use($household) {
                                                return $household->settlement->name;
                                            }),
                'household_type_id'     =>  (int)   $household->household_type_id,
                'number'                =>  str_pad($household->settlement->inner_code, 2, '0', STR_PAD_LEFT)
                                            . '-'
                                            . str_pad($household->number, 4, '0', STR_PAD_LEFT)
                                            . '-'
                                            . $household->household_type_id,
                'address'               =>  $household->address,
                'special_marks'         =>  $household->special_marks,
                'additional_data'       =>  $household->additional_data
            ];
        });
    }
}
