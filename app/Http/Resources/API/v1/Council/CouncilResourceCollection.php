<?php

namespace App\Http\Resources\API\v1\Council;

use App\Http\Resources\API\v1\Community\CommunityResource;
use App\Http\Resources\API\v1\CouncilType\CouncilTypeResource;
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
                'community'         =>  new CommunityResource($council->whenLoaded('community')),
                'council_type_id'   =>  (int)   $council->council_type_id,
                'council_type'      =>  new CouncilTypeResource($council->whenLoaded('type')),
                'name'              =>  $council->name,
                'address'           =>  $council->address,
                'edrpou'            =>  $council->edrpou,
                'koatuu'            =>  $council->koatuu
            ];
        });
    }
}
