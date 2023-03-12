<?php

namespace App\Http\Resources\API\v1\PermissionRight;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionRightResource extends JsonResource
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
            'name'          =>  $this->name,
            'right'         =>  (int) (!is_null($this->right) ?: 0),
            'read'          =>  (bool)  boolval($this->read),
            'create'        =>  (bool)  boolval($this->create),
            'update'        =>  (bool)  boolval($this->update),
            'delete'        =>  (bool)  boolval($this->delete),
        ];
    }
}
