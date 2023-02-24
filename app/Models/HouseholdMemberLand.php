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

    public function getTotalAttribute()
    {
        return  $this->maintenance +
                $this->personal_agriculture +
                $this->land_share +
                $this->property_share +
                $this->hay_cutting +
                $this->pastures;
    }
}
