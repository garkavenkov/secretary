<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'code',
        'name',
        'available_values'
    ];
}
