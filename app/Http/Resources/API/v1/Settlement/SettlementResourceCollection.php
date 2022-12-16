<?php

namespace App\Http\Resources\API\v1\Settlement;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SettlementResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($settlement) {
            return [
                'id'                    =>  (int)   $settlement->id,
                'council_id'            =>  (int)   $settlement->council_id,
                'settlement_type_id'    =>  (int)   $settlement->settlement_type_id,
                'name'                  =>  $settlement->name,
                'postcode'              =>  $settlement->postcode,
                'katottg'               =>  $settlement->katottg,
            ];
        });
    }
}
