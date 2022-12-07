<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'place_work_id',
    ];
}
