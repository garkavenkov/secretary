<?php

namespace App\Http\Resources\API\v1\PlaceWork;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PlaceWorkResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($place) {
            return [
                'id'    =>  (int)   $place->id,
                'name'  =>  $place->name
            ];
        });
    }
}
