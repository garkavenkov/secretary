<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseholdLand extends Model
{
    use HasFactory;

    protected $fillable = [
        'household_id',
        'year',
        'maintenance',
        'personal_agriculture',
        'commercial_agriculture',
    ];
}
