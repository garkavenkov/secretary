<?php

namespace App\Http\Resources\API\v1\HouseholdMember;


use App\Http\Resources\API\v1\WorkPlace\WorkPlaceResource;
use Illuminate\Http\Resources\Json\JsonResource;

use function PHPUnit\Framework\isNull;

class HouseholdMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $death_date = null;
        $death_register_number = '';
        $death_register_office = '';
        // dd($this->death);
        // if (($this->death !== '') && !isNull($this->death)) {
        if ($this->death !== '') {
        // if (!isNull($this->death)) {
            // dd($this->death);
            list($death_date, $death_register_number, $death_register_office) = explode(';', $this->death);
        }
        return [
            'id'                        =>  (int)   $this->id,
            'household_id'              =>  (int)   $this->household_id,
            'surname'                   =>  $this->surname,
            'name'                      =>  $this->name,
            'patronymic'                =>  $this->patronymic,
            'sex'                       =>  $this->sex,
            'birthday'                  =>  $this->birthday,
            'family_relationship_id'    =>  (int)   $this->family_relationship_id,
            'family_relationship'       =>  $this->when('familyRelationship', $this->familyRelationship->name),
            'employment_information'    =>  $this->employment_information,
            'work_place_id'             =>  (int)   $this->work_place_id,
            'work_place'                =>  new WorkPlaceResource($this->whenLoaded('workPlace')),
            'death_date'                =>  $death_date,
            'death_register_number'     =>  $death_register_number,
            'death_register_office'     =>  $death_register_office,
        ];
    }
}
