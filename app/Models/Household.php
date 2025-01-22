<?php

namespace App\Models;

use App\Models\Settlement;
use App\Snippets\SqlSnippet;
use App\Models\HouseholdType;
use App\Models\HouseholdHouse;
use Illuminate\Support\Facades\DB;
use App\Traits\Models\AdditionalParams;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class Household extends Model
{
    use HasFactory, AdditionalParams;

    protected $fillable = [
        'settlement_id',
        'household_type_id',
        'number',
        'address',
        'special_marks',
        'additional_data',
    ];

    protected static $filterable = [
        'settlement_id',
        'household_type_id',
        'address'
    ];

    protected $appends = array('short_address', 'full_address', 'settlement_name', 'household_head');
    // protected $appends = array('settlement_name');

    protected static function boot()
    {
        parent::boot();

        self::deleting(function($household)
        {
            // Delete land years information
            $household->landYears()->delete();

            // Delete land years information
            $household->houseYears()->delete();

            // Delete owners
            $household->owners()->delete();

            // Delete additional params values
            DB::table('additional_param_values as apv')
                ->join('additional_params as ap', 'ap.id', '=', 'apv.param_id')
                ->join('additional_param_categories as apc', 'apc.id', '=', 'ap.category_id')
                ->where('apc.code', get_class($household))
                ->where('apv.owner_id', $household->id)
                ->delete();

        });
    }

    // ***************************************  Relationships ****************************************************
    public function houseYears()
    {
        return $this->hasMany(HouseholdHouse::class)->orderBy('year', 'desc');
    }

    public function settlement()
    {
        return $this->belongsTo(Settlement::class);
    }

    public function type()
    {
        return $this->belongsTo(HouseholdType::class, 'household_type_id');
    }

    public function members()
    {
        return $this->hasMany(HouseholdMember::class);
    }
    
    public function landYears()
    {
        return $this->hasMany(HouseholdLand::class)->orderBy('year', 'desc');
    }

    public function owners(): HasMany
    {
        return $this->hasMany(HouseholdOwner::class);
    }


    // ******************************** Methods *****************************************************

    public static function isFieldFilterable($field) {
        return in_array($field, self::$filterable);
    }

    /**
     * Get household head
     *
     * @return string
     */
    public function household_head(): string
    {   
        $head = DB::table('household_members as hm')     
                    ->join('family_relationship_types as frt', 'hm.family_relationship_type_id', '=', 'frt.id')
                    ->select(
                        'hm.surname',
                        'hm.name',
                        'hm.patronymic'
                    )
                    ->where('frt.name', '=', 'голова домогосподарства')
                    ->where('hm.household_id', $this->id)
                    ->first();
        
     
        if ($head) {
            return $head->surname . ' ' . $head->name . ' ' . $head->patronymic;
        }
        return "";
    }
 

    
    public function getFullAddress(): string
    {           
        $address = DB::table('households as h') 
                    ->join('settlements as s', 's.id', '=', 'h.settlement_id')
                    ->join('settlement_types as st', 'st.id', '=', 's.settlement_type_id')
                    ->join('councils as c', 'c.id', '=', 's.council_id')
                    ->join('communities as cm', 'cm.id', '=', 'c.community_id')
                    ->join('districts as d', 'cm.district_id', '=', 'd.id')
                    ->join('regions as r', 'r.id', '=', 'd.region_id')
                    ->select(
                        'h.id as household_id',
                        'h.address as address',
                        'h.number as household_number',
                        'h.settlement_id as settlement_id',
                        's.name as settlement',
                        'st.name as settlement_type',
                        'c.name as council',
                        'cm.name as community',
                        'd.name as district',
                        'r.name as region'
                    )
                    ->where('h.id',$this->id)
                    ->first();
  
        if (!is_null($address)) {
            return generateHouseholdFullAddress($address->address, $address->settlement, $address->settlement_type, $address->district, $address->region);
        } else {
            return '';
        }

        
    }

    public function houseInfo()
    {
        $params = [
            'house_year_of_construction',
            'house_material_walls',
            'house_material_roof',
            'house_additional_data'
        ];

        return $this->additionalParamValue($params);
    }

    public function landInfo()
    {
        $params = ['land_additional_data'];

        return $this->additionalParamValue($params);
    }

    /**
     * Return household family additional param values
     *
     * @return \Illuminate\Support\Collection
     */
    public function familyInfo(): \Illuminate\Support\Collection
    {       
        return $this->additionalParamValue('family_');      
    }

    /**
     * Get household grouped by type and settlement
     *
     * @param integer|string|null $settlement_id    Settlement ID(s) (use ',' for several IDs ). If NULL - all Settlements will be used
     * @param boolean $group_by_settlement          By default data will be grouped by Settlement. Set FALSE to omit grouping by this field
     * @return array
     */
    public static function groupByType(int|string $settlement_id = null, bool $group_by_settlement = true): array
    {      

        if (!is_null($settlement_id)) {
            $group_by_settlement = true;
        }
        $types = HouseholdType::select('id')->orderBy('id')->get()->toArray();

        $sql = "SELECT ";

        if ($group_by_settlement) {
            $sql .= "settlement,";
        }

        $select_type_count_fields = '';
        foreach($types as $id => $type) {
            $select_type_count_fields .= "SUM(CASE WHEN type_id = " . $type['id'] . " THEN 1 ELSE 0 end ) as `" .$type['id'] ."` "; //.$type['name'] ."` ";
            
            // prevent put ',' after last field in SELECT befor FROM
            if ($id !== array_key_last($types)) {
                $select_type_count_fields .= ",\n";
            }
        }

        $sql .= $select_type_count_fields;
        $sql .= "FROM ( ";
        $sql .= "SELECT " . ($group_by_settlement ? "s.name as settlement, " : "") . "ht.id as type_id ";
        $sql .= "FROM 	households h ";
        $sql .= "INNER	JOIN household_types ht ON h.household_type_id  = ht.id ";

        if ($group_by_settlement) {
            $sql .= "INNER	JOIN settlements s ON h.settlement_id = s.id ";
        }
        
        if (!is_null($settlement_id)) {
            $ids = explode(',',$settlement_id);
            if (count($ids) == 1) {
                $sql .= "WHERE (s.id = $ids[0])";
            } else {
                $sql .= "WHERE (s.id IN (" . implode(",", $ids) . ") )";
            }
        }

        $sql .= ") AS r ";

        if ($group_by_settlement) {
            $sql .= "GROUP 	BY r.settlement ";
            $sql .= "ORDER  BY r.settlement";
        }


        return DB::select($sql);
    }
        
    public static function sqlBuilder(): EloquentBuilder
    {
        return Household::query()
                    ->join('settlements as s', 's.id', '=', 'households.settlement_id')
                    ->select(
                        'households.id',
                        'households.address', 
                        'households.number', 
                        'households.household_type_id',
                        'households.settlement_id',
                        's.name as settlement',
                        's.inner_code as settlement_inner_code'
                    )                            
                    ->addSelect(SqlSnippet::members_count())
                    ->addSelect(SqlSnippet::household_head());
    }

    //********************************** Attributes *********************************************************   
    public function getHouseholdNumberAttribute()
    {
        return generateHouseholdNumber($this->settlement_inner_code, $this->number, $this->household_type_id);
    }
   
    public function getShortAddressAttribute(): string
    {        
        return generateHouseholdShortAddress($this->address);
    }

   
    public function getFullAddressAttribute()
    {
        return $this->getFullAddress();
    }

    public function getHouseholdHeadAttribute()
    {
        return $this->household_head();
    }

    // *********************************************** Scopes ************************************************
    public function scopeLiving($q)
    {
        return $q->whereIn('household_type_id', [1, 2]);
    }
}