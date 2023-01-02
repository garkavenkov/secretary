<?php

namespace App\Http\Resources\API\v1\Region;

use App\Http\Resources\API\v1\District\DistrictResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
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
            'id'        =>  (int)   $this->id,
            'name'      =>  $this->name,
            'center'    =>  $this->center,
            'districts' =>  new DistrictResourceCollection($this->whenLoaded('districts')),
        ];
    }
}
