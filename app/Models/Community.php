<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'name',
        'center',
        'address',
        'edrpou',
        'koatuu'
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
