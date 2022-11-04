<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Council extends Model
{
    use HasFactory;

    protected $fillable = [
        'community_id',
        'council_type_id',
        'name',
        'address',
        'edrpou',
        'koatuu',
    ];
}
