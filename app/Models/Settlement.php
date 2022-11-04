<?php

namespace App\Models;

use App\Models\Council;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Settlement extends Model
{
    use HasFactory;

    protected $fillable = [
        'council_id',
        'settlement_type_id',
        'name',
        'postcode'
    ];

    public function council()
    {
        return $this->belongsTo(Council::class);
    }
}
