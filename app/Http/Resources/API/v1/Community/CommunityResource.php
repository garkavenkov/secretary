<?php

namespace App\Http\Resources\API\v1\Community;

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
            'name'          =>  $this->name,
            'address'       =>  $this->address,
            'edrpou'        =>  $this->edrpou,
            'koatuu'        =>  $this->koatuu
        ];
    }
}
