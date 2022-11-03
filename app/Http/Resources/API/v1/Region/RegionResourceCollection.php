<?php

namespace App\Http\Resources\API\v1\Region;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RegionResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($region) {
            return [
                'id'        =>  (int)   $region->id,
                'name'      =>  $region->name,
                'center'    =>  $region->center
            ];
        });
    }
}
