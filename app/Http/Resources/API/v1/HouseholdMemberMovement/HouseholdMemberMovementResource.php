<?php

namespace App\Http\Resources\API\v1\HouseholdMemberMovement;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\API\v1\MovementType\MovementTypeResource;
use App\Http\Resources\API\v1\HouseholdMember\HouseholdMemberResource;

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
            // 'movement_type'     =>  new MovementTypeResource($this->whenLoaded('type')),
            'movement_type'     =>  $this->type->name,
            'date'              =>  $this->date,
            'date_formatted'    =>  Carbon::parse($this->date)->format('d.m.Y'),
            'comment'           =>  $this->comment
        ];
    }
}
