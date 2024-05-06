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

    public function getFormattedTotalAttribute() {        
        return $this->total > 0 ? (number_format($this->total, 4) . ' га') : 'немає';        
    }

    public function getFormattedMaintenanceAttribute() {        
        return $this->maintenance > 0 ? (number_format($this->maintenance, 4) . ' га') : 'немає';        
    }

    public function getFormattedPersonalAgricultureAttribute() {        
        return $this->personal_agriculture > 0 ? (number_format($this->personal_agriculture, 4) . ' га') : 'немає';        
    }

    public function getFormattedLandShareAttribute() {        
        return $this->land_share > 0 ? (number_format($this->land_share, 4) . ' га') : 'немає';        
    }

    public function getFormattedPropertyShareAttribute() {        
        return $this->property_share > 0 ? (number_format($this->property_share, 4) . ' га') : 'немає';        
    }

    public function getFormattedHayCuttingAttribute() {        
        return $this->hay_cutting > 0 ? (number_format($this->hay_cutting, 4) . ' га') : 'немає';        
    }

    public function getFormattedPasturesAttribute() {        
        return $this->pastures > 0 ? (number_format($this->pastures, 4) . ' га') : 'немає';        
    }
}
