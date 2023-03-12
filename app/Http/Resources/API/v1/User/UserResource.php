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
            'name'      =>  $this->name
        ];
    }
}
