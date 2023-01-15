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
        'social_information',
        'additional_information',
        'death',
        'death_date',
        'death_register_number',
        'death_register_office',
        'land_owned',
        'land_rented',
        'land_leased'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->death = '';
            if (isset($model->death_date) &&
                isset($model->death_register_number) &&
                isset($model->death_register_office)) {
                    $death = "$model->death_date;$model->death_register_number;$model->death_register_office";
                    $model->death = $death;
            }
            unset($model->death_date);
            unset($model->death_register_number);
            unset($model->death_register_office);
        });

        static::updating(function ($model) {
            $model->death = '';
            if (isset($model->death_date) &&
                isset($model->death_register_number) &&
                isset($model->death_register_office)) {
                    $death = "$model->death_date;$model->death_register_number;$model->death_register_office";
                    $model->death = $death;
            }
            unset($model->death_date);
            unset($model->death_register_number);
            unset($model->death_register_office);
        });
    }

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
}
