<?php

namespace App\Http\Resources\API\v1\Household;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HouseholdResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {        
        
        return $this->collection->map(function($household) {            
            return [
                'id'                        =>  (int)   $household->id,
                'settlement_id'             =>  (int)   $household->settlement_id,
                'settlement'                =>  $household->settlement,                                
                'household_type_id'         =>  (int)   $household->household_type_id,
                'number'                    =>  $household->household_number, 
                'short_address'             =>  $household->short_address,
                'household_head'            =>  $household->household_head,
                'household_members_count'   =>  $household->members_count,                
            ];
        });
    }

}
