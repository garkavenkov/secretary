<?php

namespace App\Models;

use App\Models\Council;
use DateTime;
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

    public function households()
    {
        return $this->hasMany(Household::class);
    }

    public function members()
    {
        return $this->hasManyThrough(HouseholdMember::class, Household::class);
    }

    public function membersByAge($sex = null, $date = null)
    {
        $members = $this->members();

        if ($sex == 'чоловіча') {
            $members = $members->male();
        } else if ($sex == 'жіноча') {
            $members = $members->female();
        }

        $members = $members
                        ->alive($date)
                        ->get()
                        ->transform(function($member) {
                            $age = (new DateTime($member->birthdate))->diff(new DateTime())->y;
                            return ['age' => $age, 'sex' => $member->sex];
                        })
                        ->groupBy(['sex', function($item) {
                                if ($item['age'] < 18) {
                                    return '0 - 17';
                                } else if ($item['age'] >= 18 and $item['age'] <= 35) {
                                    return '18 - 35';
                                } else if ($item['age'] > 35 and $item['age'] <= 59) {
                                    return '36 - 59';
                                } else if ($item['age'] > 59 and $item['age'] <=69 ) {
                                    return '60 - 69';
                                } else if ($item['age'] > 69 and $item['age'] <=79 ) {
                                    return '70 - 79';
                                } else if ($item['age'] > 79 and $item['age'] <=89 ) {
                                    return '80 - 89';
                                } else {
                                    return '> 90';
                                }
                        }])
                        ->transform(function($sex) {
                            return $sex->map->count();
                        })
                        ->transform(function($item) {
                            return [
                                '0 - 17'  => $item['0 - 17'] ?? 0,
                                '18 - 35' => $item['18 - 35'] ?? 0,
                                '36 - 59' => $item['36 - 59'] ?? 0,
                                '60 - 69' => $item['60 - 69'] ?? 0,
                                '70 - 79' => $item['70 - 79'] ?? 0,
                                '80 - 89' => $item['80 - 89'] ?? 0,
                                '> 90'    => $item['> 90'] ?? 0,
                                'total'   => $item->sum()
                            ];
                        })
                        ->all();

        return $members;

    }
}
