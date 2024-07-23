<?php

namespace App\Http\Resources\API\v1\SettlementType;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SettlementTypeResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($type) {
            return [
                'id'            =>  (int)   $type->id,
                'name'          =>  $type->name,
                'abbreviation'  =>  $type->abbreviation
            ];
        });
    }
}
