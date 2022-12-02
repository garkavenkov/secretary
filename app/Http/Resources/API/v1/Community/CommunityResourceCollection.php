<?php

namespace App\Http\Resources\API\v1\Community;

use App\Http\Resources\API\v1\District\DistrictResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommunityResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($community) {
            return [
                'id'            =>  (int)   $community->id,
                'district_id'   =>  (int)   $community->district_id,
                'district'      =>  new DistrictResource($community->whenLoaded('district')),
                'name'          =>  $community->name,
                'address'       =>  $community->address,
                'edrpou'        =>  $community->edrpou,
                'koatuu'        =>  $community->koatuu,
            ];
        });
    }
}
