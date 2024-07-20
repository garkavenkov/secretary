<?php

namespace App\Http\Resources\API\v1\HouseholdMember;

use Illuminate\Http\Resources\Json\JsonResource;

class HouseholdMemberRelativesResource extends JsonResource
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
            'id'                    =>  (int) $this->id,
            'formatted_birthdate'   =>  $this->formatted_birthdate,
            'surname'               =>  $this->surname,
            'name'                  =>  $this->name,
            'patronymic'            =>  $this->patronymic,
            'sex'                   =>  $this->sex,
            'full_name'             =>  $this->full_name,
            'full_age'              =>  (int) $this->full_age,
            // 'full_age_with_prefix'  =>  trans_choice('plural.years', (int) $this->full_age, ['value' => $this->full_age]),
            'relation_id'           =>  (int) $this->relation_id,
            'relation'              =>  $this->relation,
        ];
    }
}
