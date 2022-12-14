<?php

namespace App\Http\Resources\API\v1\Household;

use App\Http\Resources\API\v1\HouseholdHouse\HouseholdHouseResource;
use App\Http\Resources\API\v1\HouseholdMember\HouseholdMemberResource;
use App\Http\Resources\API\v1\HouseholdType\HouseholdTypeResource;
use App\Http\Resources\API\v1\Settlement\SettlementResource;
use App\Models\HouseholdHouse;
use App\Models\HouseholdMember;
use App\Models\HouseholdType;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseholdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $members = HouseholdMemberResource::collection($this->whenLoaded('members'));

        $household_head = "";

        if ($members->count() > 0) {
            $head = $members->first(function($m) {
                // dd($m);
                return $m->familyRelationship->name == 'голова домогосподарства';
            });
            if ($head) {
                $household_head = $head->surname . ' ' . $head->name . ' ' . $head->patronymic;
            }

        }

        return [
            'id'                    =>  (int)   $this->id,
            'number'                =>  str_pad($this->settlement->inner_code, 2, '0', STR_PAD_LEFT)
                                        . '-'
                                        . str_pad($this->number, 4, '0', STR_PAD_LEFT)
                                        . '-'
                                        . $this->household_type_id,
            'info'                  =>  [
                'settlement_id'         =>  (int)   $this->settlement_id,
                'settlement'            =>  new SettlementResource($this->whenLoaded('settlement')),
                'household_type_id'     =>  (int)   $this->household_type_id,
                'household_type'        =>  new HouseholdTypeResource($this->whenLoaded('type')),
                'household_head'        =>  $household_head,
                'address'               =>  $this->address,
                'special_marks'         =>  $this->special_marks,
                'additional_data'       =>  $this->additional_data,
                'owners'                =>  $this->owners(),
            ],
            // 'members'               =>  HouseholdMemberResource::collection($this->whenLoaded('members')),
            'members'               =>  $members,
            'houseYears'            =>  HouseholdHouseResource::collection($this->whenLoaded('houseYears'))
        ];
    }
}
