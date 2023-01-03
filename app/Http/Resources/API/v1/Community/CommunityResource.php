<?php

namespace App\Http\Resources\API\v1\Community;

use App\Http\Resources\API\v1\Council\CouncilResource;
use App\Http\Resources\API\v1\District\DistrictResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommunityResource extends JsonResource
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
            'id'            =>  (int)   $this->id,
            'district_id'   =>  (int)   $this->district_id,
            'district'      =>  new DistrictResource($this->whenLoaded('district')),
            'name'          =>  $this->name,
            'address'       =>  $this->address,
            'center'        =>  $this->center,
            'edrpou'        =>  $this->edrpou,
            'koatuu'        =>  $this->koatuu,
            'councils'      =>  CouncilResource::collection($this->whenLoaded('councils')),
        ];
    }
}
