<?php

namespace App\Http\Resources\API\v1\Settlement;

use App\Http\Resources\API\v1\Council\CouncilResource;
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
            'council'               =>  new CouncilResource($this->whenLoaded('council')),
            'settlement_type_id'    =>  (int)   $this->settlement_type_id,
            'settlement_type'       =>  new SettlementResource($this->whenLoaded('type')),
            'name'                  =>  $this->name,
            'inner_code'            =>  $this->inner_code,
            'postcode'              =>  $this->postcode,
            'katottg'               =>  $this->katottg,
        ];
    }
}
