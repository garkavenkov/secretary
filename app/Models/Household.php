<?php

namespace App\Models;

use App\Models\Settlement;
use App\Models\HouseholdType;
use App\Models\HouseholdHouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        return $this->hasMany(HouseholdHouse::class)->orderBy('year');
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

    public function additionalParams($params = [])
    {
        $category = AdditionalParamCategory::where('code', get_class($this))->first();

        return $category->params($params);
    }

    public function landYears()
    {
        return $this->hasMany(HouseholdLand::class)->orderBy('year');
    }

    public function scopeLiving($q)
    {
        return $q->whereIn('household_type_id', [1, 2]);
    }

    public function owners(): HasMany
    {
        return $this->hasMany(HouseholdOwner::class);
    }

    public function fullAddress()
    {
        $settlement = $this->settlement->name;
        $settlement_type = mb_strtolower($this->settlement->type->name);
        $district = $this->settlement->council->community->district;
        $region = $district->region->name;

        return "$this->address, $settlement_type $settlement, $district->name, $region";
    }

    protected function additionalParamValues($params = [])
    {
        return DB::table('additional_params as ap')
                    ->select(
                        'ap.id as param_id',
                        'ap.code as param_code',
                        'ap.name as param_name',
                        'apv.value as param_value'
                    )
                    ->join('additional_param_categories as apc', 'apc.id', '=', 'ap.category_id')
                    ->leftJoin('additional_param_values as apv', function($join) {
                        $join->on('apv.param_id', '=', 'ap.id');
                        $join->on('apv.owner_id', '=', $this->id);
                    })
                    ->where('apc.code', get_class($this))
                    ->whereIn('ap.code', $params)
                    ->get();
    }

    public function houseInfo()
    {
        $params = ['house_built', 'house_material_walls', 'house_material_roof', 'house_additional_data'];

        return $this->additionalParamValues($params);

    }

    public function landInfo()
    {
        $params = ['land_additional_data'];

        return $this->additionalParamValues($params);
    }

    public function getAdditionalParam($param)
    {
        return DB::table('additional_params as ap')
                ->select('ap.*')
                ->join('additional_param_categories as apc', 'apc.id', '=', 'ap.category_id')
                ->where('apc.code', get_class($this))
                ->where('ap.code', $param)
                ->first();
    }

    public function setAdditionalParamValue($param_id, $value)
    {
        $apv =  AdditionalParamValue::where('param_id', $param_id)->where('owner_id', $this->id)->first();

        if (!$apv) {
            return AdditionalParamValue::create([
                'owner_id' => $this->id,
                'param_id' => $param_id,
                'value' => $value
            ]);
        } else {
            if ($apv->value !== $value) {
                $apv->value = $value;
                $apv->save();
            }
        }
        return $apv;
    }

    public function clearAdditionalParam($id)
    {
        $apv =  AdditionalParamValue::where('param_id', $id)->where('owner_id', $this->id)->first();
        if ($apv) {
            return ($apv->delete());
        } else {
            return null;
        }
    }
}
