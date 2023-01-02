<?php

namespace App\Models;

use App\Models\Settlement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function type()
    {
        return $this->belongsTo(CouncilType::class, 'council_type_id');
    }
}
