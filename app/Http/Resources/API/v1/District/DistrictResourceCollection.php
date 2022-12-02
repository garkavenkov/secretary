<?php

namespace App\Http\Resources\API\v1\District;

use App\Http\Resources\API\v1\Region\RegionResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DistrictResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($district) {
            return [
                'id'        =>  (int)   $district->id,
                'region_id' =>  (int)   $district->region_id,
                'region'    =>  new RegionResource($district->whenLoaded('region')),
                'name'      =>  $district->name,
                'center'    =>  $district->center,
            ];
        });
    }
}
