<?php

namespace App\Models;

use App\Models\Household;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HouseholdHouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'household_id',
        'year',
        'total_area',
        'total_living_area',
        'living_area',
        'room_count',
        'total_non_living_area',
        'water_supply',
        'hot_water_supply',
        'sewage',
        'central_heating',
        'individual_heating',
        'furnace_heating',
        'natural_gas',
        'liquefied_gas',
        'electric_stove',
    ];

    public function card()
    {
        return $this->belongsTo(Household::class, 'household_id', 'id');
    }
}
