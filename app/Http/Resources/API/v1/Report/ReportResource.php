<?php

namespace App\Http\Resources\API\v1\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'id'            =>  (int) $this->id,
            'name'          =>  $this->name,
            'description'   =>  $this->description,            
            'path'          =>  $this->path,
            'model'         =>  $this->model,
        ];
    }
}
