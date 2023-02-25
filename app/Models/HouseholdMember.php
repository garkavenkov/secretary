<?php

namespace App\Models;

use DateTime;
use App\Models\WorkPlace;
use App\Models\FamilyRelationship;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Resources\API\v1\HouseholdMemberMovement\HouseholdMemberMovementResource;
use App\Traits\Models\AdditionalParams;

class HouseholdMember extends Model
{
    use HasFactory, AdditionalParams;

    const MALE = 'чоловіча';
    const FEMALE = 'жіноча';

    protected $fillable = [
        'household_id',
        'surname',
        'name',
        'patronymic',
        'sex',
        'birthdate',
        'family_relationship_type_id',
        'employment_information',
        'work_place_id',
        'social_information',
        'additional_information',
        'death_date',
        'death_register_number',
        'death_register_office',
    ];

    protected $appends = array('status', 'fullAge');

    public function familyRelationshipType()
    {
        return $this->belongsTo(FamilyRelationshipType::class, 'family_relationship_type_id');
    }

    public function workPlace()
    {
        return $this->belongsTo(WorkPlace::class);
    }

    public function movements()
    {
        return $this->hasMany(HouseholdMemberMovement::class, 'member_id')->orderBy('date', 'desc');
    }

    public function movement($date = null)
    {
        if (is_null($date)) {
            return $this->movements()->first();
        }
        return $this->movements()->where('date', '<', $date)->first();
    }

    public function getStatusAttribute()
    {
        $status = 'active';

        if (is_null($this->death_date)) {
            // linivg member
            if ($this->movements->count() > 0) {
                $movement = $this->movement();
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
        return  $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
    }

    public function getShortNameAttribute()
    {
        return  $this->surname . ' ' . mb_substr($this->name, 0, 1) . '.' . mb_substr($this->patronymic, 0, 1) . '.';
    }

    public function getFullAgeAttribute()
    {
        $birthdate = new DateTime($this->birthdate);
        $interval = $birthdate->diff(new DateTime());
        return $interval->y;
    }

    public function scopeMale($query)
    {
        return $query->where('sex', self::MALE);
    }

    public function scopeFemale($query)
    {
        return $query->where('sex', self::FEMALE);
    }

    public function scopeDead($query)
    {
        return $query->whereNotNull('death_date');
    }

    public function scopeAlive($query, $date = null)
    {
        $q = $query->whereNull('death_date');
        if ($date) {
            $q = $q->orWhere('death_date', '>', $date);
        }
        return $q;
    }

    public function scopeBorn($query, $month = null, $day = null)
    {
        if (!$month) {
            $month = date('m');
        }
        if (!$day) {
            $day = date('d');
        }
        // dd("month - $month, day - $day");

        return $query->whereDay('birthdate', $day)->whereMonth('birthdate', $month);
    }

    public function relatives()
    {
        // return $this
        //         ->belongsToMany(
        //             HouseholdMember::class,
        //             FamilyRelationship::class,
        //             'member_id',
        //             'relative_id',
        //             'id',
        //             'id',
        //         )
        //         ->withPivot('relationship_type_id');

        return  DB::table('household_members as m')
                ->select(
                    'r.id as relative_id',
                    'r.surname',
                    'r.name',
                    'r.patronymic',
                    'r.birthdate',
                    'r.sex',
                    'fr.relationship_type_id',
                    'frt.name as relation'
                )
                ->join('family_relationships as fr', 'm.id', '=', 'fr.member_id')
                ->leftJoin('family_relationship_types as frt', 'frt.id', '=', 'fr.relationship_type_id')
                ->join('household_members as r', 'fr.relative_id', '=', 'r.id')
                ->where('m.id', '=', $this->id)
                ->orderBy('r.birthdate')
                ->get();
    }

    public function household()
    {
        return $this->belongsTo(Household::class);
    }

    public function memberInfo()
    {
        return $this->additionalParamValue();
    }

    public function land($years = 5)
    {
        return $this->hasMany(HouseholdMemberLand::class, 'member_id')->orderBy('year', 'desc')->limit($years);
    }
}
