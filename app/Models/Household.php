<?php

namespace App\Models;

use App\Models\Settlement;
use App\Models\HouseholdType;
use App\Models\HouseholdHouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Household extends Model
{
    use HasFactory;

    protected $fillable = [
        'settlement_id',
        'household_type_id',
        'address',
        'special_marks',
        'additional_data',
    ];

    protected static function boot()
    {

        parent::boot();

        static::creating(function($model)
        {
            $settlement = Settlement::findOrFail($model->settlement_id);

            $number = Household::where('settlement_id', $settlement->id)->max('number');
            if (is_null($number)) {
                $number = 1;
            } else {
                $number = $number + 1;
            }

            $model->number = $number;
        });
    }

    public function houseYears()
    {
        return $this->hasMany(HouseholdHouse::class);
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

    public function paramCategory()
    {
        // dd(get_class($this));
        $category = AdditionalParamCategory::where('code', 'household')->first();
        return $category ?? null;
    }

    public function params()
    {
        $category = AdditionalParamCategory::where('code', get_class($this))->first();

        return $category->params();
    }

    public function owners()
    {
        $category = AdditionalParamCategory::where('code', get_class($this))->first();
        $param = AdditionalParam::where('code', 'owner')->where('category_id', $category->id)->first();
        $owners = AdditionalParamValue::where('owner_id', $this->id)->where('param_id', $param->id)->get();

        $owners = $owners->map(function($owner) {
            $parts = explode('|', $owner->value);
            $data = [];
            $data['id'] = $owner->id;
            if (count($parts) > 1) {
                $data['name'] = $parts[0];
                $data['address'] = $parts[1];
            } else {
                $data['name'] = $owner->value;
            }
            return $data;
        });
        return $owners;
    }

    public function landYears()
    {
        return $this->hasMany(HouseholdLand::class);
    }

    public function scopeLiving($q)
    {
        return $q->whereIn('household_type_id', [1, 2]);
    }
}
