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
    ];

    public static function isFieldFilterable($field) {
        return in_array($field, self::$filterable);
    }

    protected static function boot()
    {

        parent::boot();

        // static::creating(function($model)
        // {
        //     $settlement = Settlement::findOrFail($model->settlement_id);

        //     $number = Household::where('settlement_id', $settlement->id)->max('number');
        //     if (is_null($number)) {
        //         $number = 1;
        //     } else {
        //         $number = $number + 1;
        //     }
        //     $model->number = $number;
        // });
    }

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

    public function household_head()
    {
        // dd($this->members);
        $head = $this->members->first(function($m) {
            return $m->familyRelationshipType->name == 'голова домогосподарства';
        });
        // dd($head);
        if ($head) {
            return $head->surname . ' ' . $head->name . ' ' . $head->patronymic;
        }
        return "";
    }

    public function landYears()
    {
        return $this->hasMany(HouseholdLand::class)->orderBy('year', 'desc');
    }

    public function scopeLiving($q)
    {
        return $q->whereIn('household_type_id', [1, 2]);
    }

    public function owners(): HasMany
    {
        return $this->hasMany(HouseholdOwner::class);
    }

    public function getAddress()
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

        return $this->getAddress() . ", $settlement_type $settlement, $district, $region";
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

}
