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
        'name'
    ];

    public function category()
    {
        return $this->belongsTo(AdditionalParamCategory::class, 'category_id');
    }

    public function values()
    {
        return $this->hasMany(AdditionalParamValue::class, 'param_id');
    }
}
