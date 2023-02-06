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

    public function params($codes = [])
    {
        $params = $this->hasMany(AdditionalParam::class, 'category_id');
        if (count($codes) > 0)
        {
            return $params->whereIn('code', $codes);
        }
        return $params;
    }
}
