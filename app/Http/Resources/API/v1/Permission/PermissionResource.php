<?php

namespace App\Http\Resources\API\v1\Permission;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
            'id'            =>  (int)   $this->id,
            'code'          =>  $this->code,
            'name'          =>  $this->name,
            'description'   =>  $this->description,
            'error'         =>  $this->error
        ];
    }
}
