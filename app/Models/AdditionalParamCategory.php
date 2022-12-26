<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalParamCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name'
    ];

    public function params()
    {
        return $this->hasMany(AdditionalParam::class, 'category_id');
    }
}
