<?php

namespace App\Http\Resources\API\v1\Council;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CouncilResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($council) {
            return [
                'id'                =>  (int)   $council->id,
                'community_id'      =>  (int)   $council->community_id,
                'council_type_id'   =>  (int)   $council->council_type_id,
                'name'              =>  $council->name,
                'address'           =>  $council->address,
                'edrpou'            =>  $council->edrpou,
                'koatuu'            =>  $council->koatuu
            ];
        });
    }
}
