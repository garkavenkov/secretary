<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalParamValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'param_id',
        'value',
        // unique value for [owner_id, param_id, value]
        // validation rule  (validate value before creating|saving)
    ];

}
