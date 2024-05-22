<?php

namespace App\Http\Resources\API\v1\Household;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseholdFamilyRelationsResource extends JsonResource
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
            'id'                            =>  (int)   $this->id,
            'household_id'                  =>  (int)   $this->household_id,
            'surname'                       =>  $this->surname,
            'name'                          =>  $this->name,
            'patronymic'                    =>  $this->patronymic,
            'full_name'                     =>  $this->fullName,
            'sex'                           =>  $this->sex,
            'birthdate'                     =>  $this->birthdate,
            'full_age'                      =>  $this->fullAge,
            'birthdate_formatted'           =>  Carbon::parse($this->birthdate)->format('d.m.Y'),
            'family_relationship_type_id'   =>  (int)   $this->family_relationship_type_id,
            'status'                        =>  $this->status,
            'relatives'                     =>  $this->relatives
        ];
    }
}
