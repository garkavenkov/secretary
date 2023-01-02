<?php

namespace App\Models;

use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_id',
        'name',
        'center'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function communities(): HasMany
    {
        return $this->hasMany(Community::class);
    }
}
