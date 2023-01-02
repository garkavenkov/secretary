<?php

namespace App\Http\Resources\API\v1\District;

use App\Http\Resources\API\v1\Community\CommunityResourceCollection;
use App\Http\Resources\API\v1\Region\RegionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
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
            'id'            =>  (int) $this->id,
            'region_id'     =>  (int) $this->region_id,
            'region'        =>  new RegionResource($this->whenLoaded('region')),
            'name'          =>  $this->name,
            'center'        =>  $this->center,
            'communities'   =>  new CommunityResourceCollection($this->whenLoaded('communities')),
        ];
    }
}
