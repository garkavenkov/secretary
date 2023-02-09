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

    public function params($code)
    {
        $params = $this->hasMany(AdditionalParam::class, 'category_id');
        if (is_array($code)) {
            if (count($code) > 0)
            {
                return $params->whereIn('code', $code);
            }
        } else{
            return $params->where('code', 'like', $code);
        }

    }
}
