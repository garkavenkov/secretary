<?php

namespace App\Models;

use App\Models\WorkPlace;
use App\Models\FamilyRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HouseholdMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'household_id',
        'surname',
        'name',
        'patronymic',
        'sex',
        'birthday',
        'family_relationship_id',
        'employment_information',
        'work_place_id',
    ];

    public function familyRelationship()
    {
        return $this->belongsTo(FamilyRelationship::class);
    }

    public function workPlace()
    {
        return $this->belongsTo(WorkPlace::class);
    }
}
