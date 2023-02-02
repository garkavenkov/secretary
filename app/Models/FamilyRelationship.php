<?php

namespace App\Models;

use App\Models\FamilyRelationshipType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FamilyRelationship extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'relationship_type_id',
        'relative_id'
    ];

    public function member()
    {
        return $this->belongsTo(HouseholdMember::class, 'member_id');
    }

    public function relative()
    {
        return $this->belongsTo(HouseholdMember::class, 'relative_id');
    }

    public function type()
    {
        return $this->belongsTo(FamilyRelationshipType::class, 'relationship_type_id');
    }
}
