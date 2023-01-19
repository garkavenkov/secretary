<?php

namespace App\Models;

use App\Models\WorkPlace;
use App\Models\FamilyRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Resources\API\v1\HouseholdMemberMovement\HouseholdMemberMovementResource;
use DateTime;

class HouseholdMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'household_id',
        'surname',
        'name',
        'patronymic',
        'sex',
        'birthdate',
        'family_relationship_id',
        'employment_information',
        'work_place_id',
        'social_information',
        'additional_information',
        'death_date',
        'death_register_number',
        'death_register_office',
        'land_owned',
        'land_rented',
        'land_leased'
    ];

    protected $appends = array('status', 'fullAge');

    public function familyRelationship()
    {
        return $this->belongsTo(FamilyRelationship::class);
    }

    public function workPlace()
    {
        return $this->belongsTo(WorkPlace::class);
    }

    public function movements()
    {
        return $this->hasMany(HouseholdMemberMovement::class, 'member_id')->orderBy('date', 'desc');
    }

    public function getStatusAttribute()
    {
        $status = 'active';

        if (is_null($this->death_date)) {
            // linivg member
            if ($this->movements->count() > 0) {
                $movement = $this->movements->first();
                if (in_array($movement->type->code, ['leave'])) {
                    $status = 'gone';
                }
            }
        } else {
            $status = 'dead';
        }

        return $status;
    }

    public function getFullNameAttribute()
    {
        return  $this->surname . ' ' . mb_substr($this->name, 0, 1) . '.' . mb_substr($this->patronymic, 0, 1) . '.';
    }

    public function getFullAgeAttribute()
    {
        $birthdate = new DateTime($this->birthdate);
        $interval = $birthdate->diff(new DateTime());
        return $interval->y;
    }
}
