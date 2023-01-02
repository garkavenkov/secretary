<?php

namespace App\Http\Resources\API\v1\Council;

use App\Http\Resources\API\v1\Community\CommunityResource;
use App\Http\Resources\API\v1\CouncilType\CouncilTypeResource;
use App\Http\Resources\API\v1\Settlement\SettlementResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CouncilResource extends JsonResource
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
            'id'                =>  (int)   $this->id,
            'community_id'      =>  (int)   $this->community_id,
            'community'         =>  new CommunityResource($this->whenLoaded('community')),
            'council_type_id'   =>  (int)   $this->council_type_id,
            'council_type'      =>  new CouncilTypeResource($this->whenLoaded('council_type')),
            'settlements'       =>  SettlementResource::collection($this->whenLoaded('settlements')),
            'name'              =>  $this->name,
            'address'           =>  $this->address,
            'edrpou'            =>  $this->edrpou,
            'koatuu'            =>  $this->koatuu
        ];
    }
}
