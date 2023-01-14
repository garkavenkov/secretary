<?php

namespace App\Http\Resources\API\v1\HouseholdMemberMovement;

use App\Http\Resources\API\v1\HouseholdMember\HouseholdMemberResource;
use App\Http\Resources\API\v1\MovementType\MovementTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseholdMemberMovementResource extends JsonResource
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
            'member_id'         =>  (int)   $this->member_id,
            'member'            =>  new HouseholdMemberResource($this->whenLoaded('member')),
            'movement_type_id'  =>  (int)   $this->movement_type_id,
            'movement_type'     =>  new MovementTypeResource($this->whenLoaded('type')),
            'date'              =>  $this->date,
            'comment'           =>  $this->comment
        ];
    }
}
