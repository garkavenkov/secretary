<?php

namespace App\Models;

use App\Models\Council;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Settlement extends Model
{
    use HasFactory;

    protected $fillable = [
        'council_id',
        'settlement_type_id',
        'name',
        'inner_code',
        'postcode',
        'katottg'
    ];

    public function council()
    {
        return $this->belongsTo(Council::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(SettlementType::class, 'settlement_type_id');
    }
}
