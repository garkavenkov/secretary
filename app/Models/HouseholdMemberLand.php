<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseholdMemberLand extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'year',
        'maintenance',
        'personal_agriculture',
        'land_share',
        'property_share',
        'hay_cutting',
        'pastures'
    ];
}
