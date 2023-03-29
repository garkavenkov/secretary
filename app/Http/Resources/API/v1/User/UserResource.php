<?php

namespace App\Http\Resources\API\v1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'        =>  (int)   $this->id,
            'user_name' =>  $this->user_name,
            // 'surname'   =>  $this->surname,
            'name'      =>  $this->name,
            'position'  =>  $this->position,
            'email'     =>  $this->email,
            'photo'     =>  $this->photo,
            'roles'     =>  $this->roles->map(function($r) { return $r->id;}),
        ];
    }
}
