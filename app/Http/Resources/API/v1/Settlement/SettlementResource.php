<?php

namespace App\Http\Resources\API\v1\Settlement;

use Illuminate\Http\Resources\Json\JsonResource;

class SettlementResource extends JsonResource
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
            'id'                    =>  (int)   $this->id,
            'council_id'            =>  (int)   $this->council_id,
            'settlement_type_id'    =>  (int)   $this->settlement_type_id,
            'name'                  =>  $this->name,
            'postcode'              =>  $this->postcode,
        ];
    }
}
