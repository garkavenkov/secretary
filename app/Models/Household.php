<?php

namespace App\Models;

use App\Models\Settlement;
use App\Models\HouseholdType;
use App\Models\HouseholdHouse;
use DeclensionUkrainian\Toponym;
use App\Traits\Models\AdditionalParams;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Household extends Model
{
    use HasFactory, AdditionalParams;

    protected $fillable = [
        'settlement_id',
        'household_type_id',
        'number',
        'address',
        'special_marks',
        'additional_data',
    ];

    protected static $filterable = [
        'settlement_id',
        'household_type_id',
        'address'
    ];

    // ***************************************  Relationships ****************************************************
    public function houseYears()
    {
        return $this->hasMany(HouseholdHouse::class)->orderBy('year', 'desc');
    }

    public function settlement()
    {
        return $this->belongsTo(Settlement::class);
    }

    public function type()
    {
        return $this->belongsTo(HouseholdType::class, 'household_type_id');
    }

    public function members()
    {
        return $this->hasMany(HouseholdMember::class);
    }
    
    public function landYears()
    {
        return $this->hasMany(HouseholdLand::class)->orderBy('year', 'desc');
    }

    public function owners(): HasMany
    {
        return $this->hasMany(HouseholdOwner::class);
    }


    // ******************************** Methods *****************************************************

    public static function isFieldFilterable($field) {
        return in_array($field, self::$filterable);
    }

    public function household_head()
    {        
        $head = $this->members->first(function($m) {
            return $m->familyRelationshipType->name == 'голова домогосподарства';
        });
        
        if ($head) {
            return $head->surname . ' ' . $head->name . ' ' . $head->patronymic;
        }
        return "";
    }

    public function getShortAddress()
    {
        $parts = explode(',', $this->address);
        $address = "$parts[0] $parts[1], буд. $parts[2]";

        // корпус
        $address = $address . ($parts[3] !== '' ? ", корп. $parts[3]" : "");

        // квартира
        $address = $address . ($parts[4] !== '' ? ", кв. $parts[4]" : "");

        return $address;
    }

    public function getFullAddress()
    {
        $settlement = $this->settlement->name;
        $settlement_type = mb_strtolower($this->settlement->type->name);
        $district = $this->settlement->council->community->district;
        $region = $district->region->name;

        $district = explode(' ', $district->name);
        $district = Toponym::inGenetive(['name' => $district[0], 'type' => $district[1]]);

        $region = explode(' ', $region);
        $region = Toponym::inGenetive(['name' => $region[0], 'type' => $region[1]]);

        return $this->getShortAddress() . ", $settlement_type $settlement, $district, $region";
    }

    public function houseInfo()
    {
        $params = [
            'house_year_of_construction',
            'house_material_walls',
            'house_material_roof',
            'house_additional_data'
        ];

        return $this->additionalParamValue($params);
    }

    public function landInfo()
    {
        $params = ['land_additional_data'];

        return $this->additionalParamValue($params);
    }

    public function familyInfo()
    {
        $params = $this->additionalParams('family_%')
                        ->get()
                        ->map(function($p) {
                            return $p->code;
                        })
                        ->toArray();

        return $this->additionalParamValue($params);
    }


    public function fullNumber()
    {
        return  str_pad($this->settlement->inner_code, 2, '0', STR_PAD_LEFT)
                . '-'
                . str_pad($this->number, 4, '0', STR_PAD_LEFT)
                . '-'
                . $this->household_type_id;
    }

    //********************************** Attributes *********************************************************
    public function getSettlementNameAttribute()
    {
        return $this->settlement->name;
    }

    public function getHouseholdNumberAttribute()
    {
        return $this->fullNumber();
    }

    public function getHouseholdHeadAttribute()
    {
        return $this->household_head();
    }

    public function getShortAddressAttribute()
    {
        return $this->getShortAddress();
    }

    public function getFullAddressAttribute()
    {
        return $this->getFullAddress();
    }

    // *********************************************** Scopes ************************************************
    public function scopeLiving($q)
    {
        return $q->whereIn('household_type_id', [1, 2]);
    }
}
