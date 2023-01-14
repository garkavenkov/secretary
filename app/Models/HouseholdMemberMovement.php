<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseholdMemberMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'movement_type_id',
        'date',
        'comment'
    ];

    public function type()
    {
        return $this->belongsTo(MovementType::class, 'movement_type_id');
    }
}
