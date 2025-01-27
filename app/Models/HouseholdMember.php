<?php

namespace App\Models;

use DateTime;
use App\Models\WorkPlace;
use Illuminate\Support\Facades\DB;
use DeclensionUkrainian\Anthroponym;
use App\Traits\Models\AdditionalParams;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

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

    protected static $filterable = [
        'settlement_id',
        'sex',
    ];
    
    
    // protected $appends = array('status', 'fullAge');
    protected $appends = array('fullAge', 'full_address');


    protected static function boot()
    {
        parent::boot();

        self::deleting(function($member)
        {
            // Delete land years information
            $member->landYears()->delete();

            // Delete additional params values
            DB::table('additional_param_values as apv')
                ->join('additional_params as ap', 'ap.id', '=', 'apv.param_id')
                ->join('additional_param_categories as apc', 'apc.id', '=', 'ap.category_id')
                ->where('apc.code', get_class($member))
                ->where('apv.owner_id', $member->id)
                ->delete();

            // Movements
            $member->movements()->delete();

            // Family relationships
            DB::table('family_relationships as fr')
                ->where('fr.member_id',$member->id)
                ->orWhere('fr.relative_id', $member->id)
                ->delete();
        });
    }


    public static function isFieldFilterable($field) {
        return in_array($field, self::$filterable);
    }


    // ***************************************  Relationships ****************************************************
    
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

    public function household()
    {
        return $this->belongsTo(Household::class);
    }

    public function landYears()
    {
        return $this->hasMany(HouseholdMemberLand::class, 'member_id')->orderBy('year', 'desc');
    }

    //********************************** Attributes *********************************************************
    /*
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
    */
    public function getFullNameAttribute()
    {
        return  $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
    }

    public function getFullNameInDativeAttribute()
    {
        return  Anthroponym::inDative([
            'gender'    =>  $this->sex,
            'surname'   =>  $this->surname,
            'name'      =>  $this->name,
            'patronymic'=>  $this->patronymic,
        ]);
    }

    public function getShortNameAttribute()
    {
        return  $this->surname . ' ' 
                    . mb_substr($this->name, 0, 1) . '.' 
                    . mb_substr($this->patronymic, 0, 1) . '.';
    }

    public function getBirthdateFormattedAttribute()
    {
        return (new DateTime($this->birthdate))->format('d.m.Y');
    }

    public function getDeathDateFormattedAttribute()
    {
        if ($this->death_date) {
            return (new DateTime($this->death_date))->format('d.m.Y');
        }
        return  null;
    }

    public function getFullAgeAttribute()
    {
        $birthdate = new DateTime($this->birthdate);
        
        if ($this->status == 'dead') {  
            return $birthdate->diff(new DateTime($this->death_date))->y;
        } 

        return $birthdate->diff(new DateTime())->y;
  
    }

    public function getRegistrationAddressAttribute()
    {
        $address =$this->household->getFullAddress();
           
        return ($this->sex == 'чоловіча' ? 'зареєстрований' : 'зареєстрована') . 
                " за адресою: $address";

    }

    public function getRelativesAttribute()
    {
        return $this->relatives()->toArray();
    }

    // public function getFullAddressAttribute()
    // {
    //     return $this->household->getFullAddress();       
    // }

    public function getGenderAttribute()
    {
        return $this->sex == 'чоловіча' ? 'male' : ($this->sex == 'жіноча' ? 'female' : null);
    }

    // ******************************** Methods *****************************************************

    public function relatives($only_alive = true)
    {        
        $db_conn = config('database.default');
        
        if ($db_conn == 'sqlite') {
            $full_name = "hm.surname || ' ' || hm.name || ' ' || hm.patronymic as full_name";
            $formatted_birthdate = "STRFTIME('%d.%m.%Y', hm.birthdate) as formatted_birthdate";
        } else if ($db_conn == 'mysql') {
            $full_name = "CONCAT(hm.surname, ' ', hm.name, ' ',hm.patronymic) as full_name";
            $formatted_birthdate = "DATE_FORMAT(hm.birthdate, '%d.%m.%Y') as formatted_birthdate";
        }

        return DB::table('family_relationships as fr')
                ->selectRaw(
                    "hm.id, 
                    hm.surname,
                    hm.name,
                    hm.patronymic,
                    $full_name,
                    -- hm.birthdate,
                    $formatted_birthdate,
                    hm.sex,
                    frt.id as relation_id,
                    frt.name as relation"
                )
                ->addSelect(DB::raw(HouseholdMember::memberFullAgeSQLSnippet(date('Y-m-d'))))
                ->join('family_relationship_types as frt', 'frt.id', '=', 'fr.relationship_type_id')
                ->join('household_members as hm', 'hm.id', '=', 'fr.relative_id')
                ->when($only_alive, function($q) {
                    $q->whereNull('hm.death_date');
                })
                ->where('fr.member_id', '=', $this->id)
                ->get();
    }

    
    public function memberInfo()
    {
        return $this->additionalParamValue();
    }

    public function declensionFullName(string $case): String
    {
        return  Anthroponym::$case([
            'gender'    =>  $this->sex,
            'surname'   =>  $this->surname,
            'name'      =>  $this->name,
            'patronymic'=>  $this->patronymic,
        ]);
    }

    /**
     * Return inforbation about member's land for partuclar $year
     * or null if information doesn't exist
     *
     * @param integer $year Year
     * @return HouseholdMemberLand|null
     */
    public function landYear(int $year): ?HouseholdMemberLand
    {
        return $this->landYears()->where('year', $year)->first();
    }
    
    public function died(string $date, string $register_number, string $register_office)
    {
        $this->death_date            = $date;
        $this->death_register_number = $register_number;
        $this->death_register_office = $register_office;
        
        $this->save();
    }

    /**
     * Return SQL snippet which calculates member's full age on particular date
     * If date is not passed, will be used current date.
     * Available database connection: (MySQL, SQLITE)
     *
     * @param [type] $date  Date in format 'YYYY-MM-DD'
     * @return string
     */
    public static function memberFullAgeSQLSnippet($date): string
    {
        $db_conn = config('database.default');
        if ($db_conn == 'sqlite') {
            //  'now'
            $sql = "
            (   strftime('%Y', DATE('$date')) - strftime('%Y', birthdate) + 			
                case 
                    when(strftime('%m', DATE('$date')) - strftime('%m', birthdate) ) < 0  then -1
                    when (strftime('%m', DATE('$date')) - strftime('%m', birthdate) ) = 0 then 
                        case 
                            when (strftime('%d', DATE('$date')) - strftime('%d', birthdate) ) < 0 then -1
                            else 0
                        end
                    else 0
                end 
            ) as full_age ";

        } else if ($db_conn == 'mysql') {
            // CURDATE()
            $sql = "
            (   YEAR('$date') - YEAR(birthdate) +
                case 
                    when ( MONTH('$date') - MONTH(birthdate) ) < 0 then -1
                    when ( MONTH('$date') - MONTH(birthdate) ) = 0 then
                        case
                            when ( DAY('$date') - DAY(birthdate) ) < 0 then -1
                            else 0
                        end
                    else 0			
                end
            ) AS full_age ";
        }
        
        return $sql;

    }

    /**
     * Get members grouped by age ranges, settlement and gender
     *
     * @param array $ages           
     * @param integer|string|null $settlement_id    Settlement ID(s) (use ',' for several IDs ). If NULL - all Settlements will be used
     * @param string|null $gender                   Member's gender ('жіноча' | 'чоловіча'). If NULL - both genders will be used
     * @param string|null $date                     The Date in format ('YYYY-MM-DD') on which the data will be generated. If NULL - current date will be used
     * @param boolean $group_by_settlement          By default data will be grouped by Settlement. Set FALSE to omit grouping by this field
     * @param boolean $group_by_gender              By default data will be grouped by gender. Set FALSE to omit grouping by this field
     * @return array                                
     */
    public static function groupByAgeRanges(
                array $ages, 
                int|string $settlement_id = null, 
                string $gender = null, 
                string $date = null, 
                bool $group_by_settlement = true, 
                bool $group_by_gender = true): array
    {
        
        if (is_null($date)) {
            $date = (new DateTime)->format('Y-m-d');
        }

        if (!is_null($settlement_id)) {
            $group_by_settlement = true;
        }

        if (!is_null($gender)) {
            $group_by_gender = true;
        }

      
        $select_age_ranges_fields = "";

        $case_age_range_sql = "CASE\n";
       

        foreach($ages as $name => $range) {

            $case_age_range_sql .= " WHEN res.full_age >= ". $range[0] . " AND res.full_age <= " . $range[1] . " then '$name'\n";
            $select_age_ranges_fields .= "SUM(CASE WHEN r.age_range = '$name' THEN 1 ELSE 0 end ) as '$name' ";
            
            // prevent put ',' after last field in SELECT befor FROM
            if ($name !== array_key_last($ages)) {
                $select_age_ranges_fields .= ",\n";
            }

        }

        $case_age_range_sql .= "END AS age_range\n";

        $sql = "SELECT ";
        
        if ($group_by_settlement) {
            $sql .= "settlement, ";
        }
        if ($group_by_gender) {
            $sql .= "gender, ";
        }        

        $sql .= $select_age_ranges_fields;
		        
        $sql .= 
        "FROM (
            SELECT 	res.settlement,
		            res.gender,";
        $sql .= $case_age_range_sql;
		        
        $sql .= "FROM (
                SELECT 	s.name AS settlement,
		                hm.sex AS gender,";

        $sql .= self::memberFullAgeSQLSnippet($date);
		                
        $sql .="FROM 	household_members hm
                INNER	JOIN households h ON h.id = hm.household_id 
                INNER 	JOIN settlements s  ON s.id = h.settlement_id 
                WHERE 	(hm.death_date  IS NULL || hm.death_date > DATE('$date')) ";

        //  Make select for particular settlement(s)
        if (!is_null($settlement_id)) {
            $ids = explode(',',$settlement_id);
            if (count($ids) == 1) {
                $sql .= " AND (s.id = $ids[0])";
            } else {
                $sql .= " AND (s.id IN (" . implode(",", $ids) . ") )";
            }
        }

        //  Make select for particular gender
        if (!is_null($gender)) {            
            $sql .= " AND (hm.sex = '$gender')";
        }
        $sql .= ") AS res ) AS r ";


        if ($group_by_settlement || $group_by_gender) {
            $sql .= " GROUP BY " 
                    . ($group_by_settlement ? 'settlement' : '')
                    . ($group_by_gender ? ($group_by_settlement ? ', gender' : 'gender') : '' );
            
        }
       

        return DB::select($sql);
    }    

    public static function sqlBuilder($date = null): EloquentBuilder
    {
        if (is_null($date)) {
            $date = date('Y-m-d');
        }
        return HouseholdMember::query()        
                    ->select(
                        'household_members.id',
                        'household_members.household_id',
                        'household_members.surname',
                        'household_members.name',
                        'household_members.patronymic',
                        'household_members.sex',
                        'household_members.birthdate',
                        'household_members.family_relationship_type_id',                                
                        'frt.name as family_relationship_type',
                        'household_members.employment_information',
                        'household_members.social_information',
                        'household_members.additional_information',
                        'household_members.work_place_id',
                        'wp.name as work_place',
                        'household_members.death_date',
                        'household_members.death_register_number',
                        'household_members.death_register_office',
                        'h.number',                                 // for HouseholdNumber
                        'h.household_type_id',                      // for HouseholdNumber
                        's.inner_code as  settlement_inner_code',   // fof HouseholdNumber
                        'h.address',                                // for ShortAddress / FullAddress
                        's.name as settlement',                     // for FullAddress
                        'st.abbreviation as settlement_type',       // for FullAddress
                        'd.name as district',                       // for FullAddress
                        'r.name as region'                          // for FullAddress        
                    )
                    ->addSelect(DB::raw(
                            "CASE 
                                WHEN household_members.death_date IS NOT NULL THEN 'dead'                                
                                WHEN movements.code = 'leave' THEN 'gone'
                                WHEN movements.code IS NULL OR movements.code = 'register' THEN 'active'
                            END AS status"        
                        )
                    )
                    ->join('family_relationship_types as frt', 'household_members.family_relationship_type_id', '=', 'frt.id')
                    ->join('households as h', 'household_members.household_id', '=', 'h.id')
                    ->join('settlements as s', 'h.settlement_id', '=', 's.id')
                    ->join('settlement_types as st', 'st.id', '=', 's.settlement_type_id')
                    ->join('councils as c', 'c.id', '=', 's.council_id')
                    ->join('communities as com', 'com.id', '=', 'c.community_id')
                    ->join('districts as d', 'd.id', '=', 'com.district_id')
                    ->join('regions as r', 'r.id', '=', 'd.region_id')
                    ->leftJoin('work_places as wp', 'household_members.work_place_id', '=', 'wp.id')
                    ->leftJoin(DB::raw("
                            (
                                SELECT 	mt.code, hmm.member_id 
                                FROM 	household_member_movements hmm
                                JOIN	movement_types mt ON hmm.movement_type_id = mt.id
                                ORDER	BY hmm.date DESC 
                                LIMIT 	1 
                            ) movements"
                        ), 'movements.member_id', '=', 'household_members.id'
                    );
                    // ->where(function($q) use($date) {
                    //     return $q->whereNull('household_members.death_date')
                    //                 ->orWhere('household_members.death_date', '>', $date);
                    // });
    }

    // *********************************************** Scopes ************************************************

    public function scopeMale($query)
    {
        return $query->where('sex', self::MALE);
    }

    public function scopeFemale($query)
    {
        return $query->where('sex', self::FEMALE);
    }

    public function scopeDead($query, $date = null)
    {
        if (!$date) {
            $date = date('Y-m-d');
        }
        return $query->where(function($q) use($date) {
            return $q->where('death_date', '<=', $date);
        });
    }

    public function scopeAlive($query, $date = null)
    {
        $q = $query->whereNull('death_date');
        if ($date) {
            $q = $q->orWhere('death_date', '>', $date);
        }
        return $q;
    }

    public function scopeActive($query, $date = null)
    {
        if (!$date) {
            $date = date('Y-m-d');
        }
        $q = $query
                ->leftJoin('household_member_movements as hmm', 'hmm.id', '=', DB::raw(
                    "(  SELECT 	hmm2.id
                        FROM 	household_member_movements hmm2 
                        WHERE 	    hmm2.member_id = household_members.id
                                and hmm2.date <  '$date'
                        ORDER BY hmm2.date DESC
                        LIMIT 1  )")                        
                )
                ->leftJoin('movement_types as mt', 'mt.id', '=', 'hmm.movement_type_id' )
                ->where(function($q) use($date) {
                    return $q->whereNull('household_members.death_date')
                                ->orWhere('household_members.death_date', '>', $date);
                })
                ->where(function($q) {
                    return  $q->whereNull('mt.code')
                                ->orWhere('mt.code', '<>', "leave");
                }
            );
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
        return $query->whereDay('birthdate', $day)->whereMonth('birthdate', $month);
    }

   
}