<?php

namespace App\Models;

use DateTime;
use App\Models\Council;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function households($type = null)
    {
        $h = $this->hasMany(Household::class);

        if (!is_null($type)) {
            if (is_array($type)) {
                $h = $h->whereIn('household_type_id', $type)->get();
            } else {
                $h = $h->where('household_type_id', $type)->get();
            }
        }
        return $h;
    }

    public function living()
    {
        return $this->households->whereIn('household_type_id', [1,2]);
    }

    public function members()
    {
        return $this->hasManyThrough(HouseholdMember::class, Household::class);
    }

    public function membersByAge(array $ages, string $sex = null, $date = null)
    {
        if (is_null($date)) {
            $date = (new DateTime)->format('Y-m-d');
        }
        
        $members = $this->members();

        if ($sex == 'чоловіча') {
            $members = $members->male();
        } else if ($sex == 'жіноча') {
            $members = $members->female();
        }
        

        $members = $members
                        ->alive($date)
                        ->get()                        
                        ->transform(function($member) use($date) {                            
                            $age = (new DateTime($member->birthdate))->diff(new DateTime($date))->y;
                            return ['age' => $age, 'sex' => $member->sex];
                        })                        
                        ->groupBy(['sex', function($item) use ($ages) {
                                foreach($ages as $name => $range) {
                                    if ($item['age'] >= $range[0] and $item['age'] <= $range[1]) {
                                        return $name;
                                    }
                                }                      
                        }])
                        ->transform(function($sex) {
                            return $sex->map->count();
                        })
                        ->transform(function($item) use ($ages) {                                                        
                            $result = [];
                            foreach(array_keys($ages) as $range) {
                                $result[$range]  = $item[$range] ?? 0;
                            }
                            $result['total'] = $item->sum();
                            return $result;
                        })
                        ->all();
                        
        return $members;
    }    

    // public function activeMembers($date = null)
    // {
        
    //     return DB::table('household_members as hm')
    //                 ->select('hm.*')
    //                 ->addSelect('mt.code as movement')        
    //                 ->join('households as h', 'h.id', '=', 'hm.household_id')
    //                 ->join('settlements as s', 's.id', '=', 'h.settlement_id')                                        
    //                 ->leftJoin('household_member_movements as hmm', 'hmm.id', '=', DB::raw(
    //                     "(  SELECT 	hmm2.id
    //                         FROM 	household_member_movements hmm2 
    //                         WHERE 	    hmm2.member_id = hm.id
    //                                 and hmm2.date <  '$date'
    //                         ORDER BY hmm2.date DESC
    //                         LIMIT 1  )")                        
    //                 )
    //                 ->leftJoin('movement_types as mt', 'mt.id', '=', 'hmm.movement_type_id' )
    //                 ->where(function($q) use($date) {
    //                     $q = $q->whereNull('death_date');
    //                     if ($date) {
    //                         $q = $q->orWhere('death_date', '>', $date);
    //                     }
    //                     return $q;
    //                 })                    
    //                 ->where('s.id', $this->id)
    //                 ->get()
    //                 ->filter(function($m) {
    //                     return $m->movement != 'leave' || is_null($m->movement);
    //                 });        
    // }
}
