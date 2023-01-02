<?php

namespace App\Http\Resources\API\v1\Settlement;

use App\Http\Resources\API\v1\Council\CouncilResource;
use App\Http\Resources\API\v1\SettlementType\SettlementTypeResource;
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
                'council'               =>  new CouncilResource($settlement->whenLoaded('council') ),
                'settlement_type_id'    =>  (int)   $settlement->settlement_type_id,
                'settlement_type'       =>  new SettlementTypeResource($settlement->whenLoaded('type')),
                'name'                  =>  $settlement->name,
                'inner_code'            =>  $settlement->inner_code,
                'postcode'              =>  $settlement->postcode,
                'katottg'               =>  $settlement->katottg,
            ];
        });
    }
}
