<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalParam extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'code',
        'name',
        'value_type_id',
        'is_system',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($model) {
            $model->values()->delete();
            $model->conditions()->delete();
        });

    }

    public function category()
    {
        return $this->belongsTo(AdditionalParamCategory::class, 'category_id');
    }

    public function values()
    {
        return $this->hasMany(AdditionalParamValue::class, 'param_id');
    }

    public function valueType()
    {
        return $this->belongsTo(AdditionalParamValueType::class, 'value_type_id');
    }

    public function conditions()
    {
        return $this->hasMany(AdditionalParamCondition::class, 'param_id');
    }
}
