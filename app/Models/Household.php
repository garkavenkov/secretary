<?php

namespace App\Models;

use App\Models\HouseholdHouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Household extends Model
{
    use HasFactory;

    protected $fillable = [
        'community_id',
        'household_type_id',
        'address',
        'special_marks',
        'additional_data',
    ];

    public function house()
    {
        return $this->hasMany(HouseholdHouse::class);
    }
}
