<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalParamCondition extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'param_id',        
        'attribute_id',
        'condition',
        'value'
    ];

    public function attribute()
    {
        return $this->belongsTo(ModelAttribute::class, 'attribute_id', 'id');
    }
}
