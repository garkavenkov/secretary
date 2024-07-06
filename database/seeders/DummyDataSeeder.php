<?php

namespace Database\Seeders;

use DateTime;
use Carbon\Carbon;
use Faker\Generator;
use App\Models\Household;
use App\Models\Settlement;
use App\Models\HouseholdLand;
use App\Models\HouseholdHouse;
use App\Models\AdditionalParam;
use App\Models\HouseholdMember;
use Illuminate\Database\Seeder;
use App\Models\HouseholdMemberLand;
use Illuminate\Container\Container;
use App\Models\FamilyRelationshipType;
use App\Models\AdditionalParamCategory;
use App\Models\HouseholdOwner;
use DeclensionUkrainian\Patronymic;

class DummyDataSeeder extends Seeder
{

    /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Family relationship types in relation to the Household head
     *
     * @var array
     */
    protected $family_relationships = [];

    /**
     * Additional params id for Household and HouseholdMember
     *
     * @var array
     */
    protected $additional_params = [];
    /**
     * Household number for settlements
     *
     * @var integer
     */
    protected $household_number = 1;

    /**
     * Streets with house number in a settlemet
     *
     * @var array
     */
    protected $streets = [];

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();

        $this->family_relationships['head']     = FamilyRelationshipType::whereName('голова домогосподарства')->first()->id;
        $this->family_relationships['wife']     = FamilyRelationshipType::whereName('дружина')->first()->id;
        $this->family_relationships['husband']  = FamilyRelationshipType::whereName('чоловік')->first()->id;
        $this->family_relationships['daughter'] = FamilyRelationshipType::whereName('дочка')->first()->id;
        $this->family_relationships['son']      = FamilyRelationshipType::whereName('син')->first()->id;
        $this->family_relationships['mother']   = FamilyRelationshipType::whereName('мати')->first()->id;
        $this->family_relationships['father']   = FamilyRelationshipType::whereName('батько')->first()->id;        

        $household_category = AdditionalParamCategory::where('code', 'App\Models\Household')->first();

        $this->additional_params['family_multi_child']      = AdditionalParam::where('code', 'family_multi_child')
                                                                                ->where('category_id', $household_category->id)
                                                                                ->first()->id;

        $this->additional_params['family_single_parent']    = AdditionalParam::where('code', 'family_single_parent')
                                                                                ->where('category_id', $household_category->id)
                                                                                ->first()->id;
        
        $this->additional_params['family_single_parent_multi_child'] = AdditionalParam::where('code', 'family_single_parent_multi_child')
                                                                                ->where('category_id', $household_category->id)
                                                                                ->first()->id;
                                                                                
        $household_member_category = AdditionalParamCategory::where('code', 'App\Models\HouseholdMember')->first();
        $this->additional_params['single_parent']    = AdditionalParam::where('code', 'single_parent')
                                                                        ->where('category_id', $household_member_category->id)
                                                                        ->first()->id;
        
        $this->additional_params['single_parent_multi_child'] = AdditionalParam::where('code', 'single_parent_multi_child')
                                                                        ->where('category_id', $household_member_category->id)
                                                                        ->first()->id;

        $this->additional_params['child_disabled'] = AdditionalParam::where('code', 'child_disabled')
                                                                        ->where('category_id', $household_member_category->id)
                                                                        ->first()->id;

    }


    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    
    /**
     * Generate a discrete random variable with a given distribution law
     *
     * @return integer
     */
    protected function randomValueWithDistributionLaw(array $distribution_law): mixed
    {        
        $random = rand(1, 100);       

        $distribution = 0;
        foreach ($distribution_law as $value => $distribution_law_value) {
            $distribution += $distribution_law_value;
            if ($random <= $distribution) {
                return $value;
            }
        }
        
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        // Clean up data for Household and HouseholdMember with all their relationships
        foreach(HouseholdMember::all() as $hm) {
            $hm->delete();
        }
        HouseholdMember::truncate();

        foreach(Household::all() as $h) {
            $h->delete();
        }
        Household::truncate();

        HouseholdLand::truncate();
        HouseholdOwner::truncate();
        HouseholdHouse::truncate();
        HouseholdMemberLand::truncate();

        // Settlements for which data will be generated
        $settlements = Settlement::all();

        $households_per_settlement = 80;
        
        $streets_count = 5;

        foreach($settlements as $settlement) {

            $this->household_number = 1;

            $this->streets = $this->generateStreets($streets_count);
            
            for($i = 1; $i <=$households_per_settlement; $i++) {
             
                $household = $this->generateHousehold($settlement->id);
                                
                if (in_array($household->household_type_id, [1,2])) {
                    
                    $household_head_father = $this->generateHouseholdHeadParents($household->id);
                    
                    $household_head = $this->generateHouseholdHead(household: $household, household_owner: true, father: $household_head_father);
                   
                    $household_head_spouse = $this->generateHouseholdHeadSpouse($household_head);
                    
                    $children_count = $this->generateChildren(head: $household_head, spouse: $household_head_spouse);
                    
                    // Set additional params for Household and HouseholdMember                    
                    if (is_null($household_head_spouse)) {
                        if ($children_count >=3 ) {                            
                            $household->setAdditionalParamValue($this->additional_params['family_single_parent_multi_child'], true);
                            $household_head->setAdditionalParamValue($this->additional_params['single_parent_multi_child'], true);
                        } else if ($children_count > 0) {
                            $household->setAdditionalParamValue($this->additional_params['family_single_parent'], true);
                            $household_head->setAdditionalParamValue($this->additional_params['single_parent'], true);
                        }
                    } else {
                        if ($children_count >=3 ) {                            
                            $household->setAdditionalParamValue($this->additional_params['family_multi_child'], true);
                        }
                    }

                }                
                echo chr(27) . "[0G    \e[39mГенерація домогосподарств для \e[91m$settlement->name\t \e[92m$i \e[39mз \e[92m$households_per_settlement";
            }
            echo ".\t\e[39mЗгенеровано мешканців: \e[93m" . $settlement->members()->count() . "\e[39m\n";            
            
        }
        echo "\n";
        
    }

    /**
     * Generate associative array with street name and house number starts with 1     
     *
     * @param integer $count    Streets count
     * @return array            Array with street names and house number
     */
    protected function generateStreets(int $count): array
    {
        $streets = [];

        if ($count > 0) {
            for( $i = 0 ; $i<$count; $i++) {
                $streets[$i] = [$this->faker->unique()->streetName(), 1];
            }        
        }

        return $streets;
    }

    /**
     * Generate Household Head' parents
     *
     * @param integer $household_id Household
     * @return HouseholdMember      Household head's father
     */
    private function generateHouseholdHeadParents(int $household_id): HouseholdMember
    {
        $birthdate = $this->faker->dateTimeBetween('-90 years', '-70 years');
        // Household head's father
        $father = $this->generateHouseholdMember( 
                        household_id: $household_id,                 
                        family_relationship_type_id: $this->family_relationships['father'],
                        gender: 'male',                        
                        birthdate: $birthdate
        );
        if ($this->randomValueWithDistributionLaw(['dead' => 80, 'alive'  => 20 ]) == 'dead') {
            $father->died(
                        date:  $this->faker->dateTimeBetween('-20 years', '-10 years')->format('Y-m-d'),
                        register_number: $this->faker->regexify('I-[A-Z]{2};[0-9]{6}'),
                        register_office: $this->faker->text(7)
                    );
        }
        
        // Household head's mother
        $birthdate = $this->generateBirthdateInYearsInverval($father->birthdate, start: 0, end: 5);
        $mother = $this->generateHouseholdMember( 
                        household_id: $household_id,                 
                        family_relationship_type_id: $this->family_relationships['mother'],
                        gender: 'female',
                        birthdate: $birthdate,
                        surname: $father->surname
        );
        if ($this->randomValueWithDistributionLaw(['dead' => 70, 'alive'  => 30 ]) == 'dead') {
            $mother->died(
                        date:  $this->faker->dateTimeBetween('-20 years', '-10 years')->format('Y-m-d'),
                        register_number: $this->faker->regexify('I-[A-Z]{2};[0-9]{6}'),
                        register_office: $this->faker->text(7)
                    );
        }

        return $father;
    }


    /**
     * Generate Household's head
     *
     * @param Household $household      Household
     * @param boolean $household_owner  Generate Household owner
     * @return HouseholdMember
     */
    protected function generateHouseholdHead(Household $household, bool $household_owner = true, ?HouseholdMember $father): HouseholdMember
    {
        $birthdate = $this->faker->dateTimeBetween('-60 years', '-40 years');
                   
        
        $head = $this->generateHouseholdMember(
                household_id: $household->id, 
                // household_id: 1,
                family_relationship_type_id: $this->family_relationships['head'],
                gender: $this->randomValueWithDistributionLaw(['male' => 70, 'female'  => 30 ]),
                father_name: !is_null($father) ? $father->name : '',
                surname: !is_null($father) ? $father->surname : '', 
                birthdate: $birthdate
            ); 
            
        if ($household_owner) {
            $household->owners()->create([
                'name'      =>  $head->fullName,
                'address'   =>  $head->shortAddress,
            ]);
        }

        // Generate HouseholdMemberLandYears
        if (rand()&1) {
            $years = $this->randomValueWithDistributionLaw([1 => 5, 2 => 10, 3 => 15, 4 => 20, 5 => 50]);
            
            $last_land_year = HouseholdMemberLand::factory()
                                    ->create([
                                        'member_id' =>  $head->id,
                                        'year'      =>  (new DateTime)->format('Y'),                                    
                                    ]);

            for($i=1; $i<=$years-1; $i++) {                                            
                $land_year = $last_land_year
                                    ->replicate()
                                    ->fill([
                                        'year'  => $last_land_year->year - $i
                                    ]);
                $land_year->save();
            }
                            
                            
        }

        return $head;
    }

    /**
     * Generate Household's head's spouse (wife or husband depends on Household's head gender)
     *
     * @todo When spouse is male, change Household head surname to spouse's surname
     * 
     * @param HouseholdMember $head     Household's head
     * @return HouseholdMember|null     Returns household head's spouse or null
     */
    protected function generateHouseholdHeadSpouse(HouseholdMember $head): ?HouseholdMember
    {
        if ($this->randomValueWithDistributionLaw(['married' => 75, 'single'  => 25 ]) == 'married') {
            
            $spouse_gender =  $head->gender == 'male' ? 'female' : 'male';
            
            $spouse_birthdate = $this->generateBirthdateInYearsInverval($head->birthdate, start: 5, end: 5);
            
            $family_relationship_type_id = $spouse_gender == 'female' 
                                                ? $this->family_relationships['wife'] 
                                                : $this->family_relationships['husband'];

            return $this->generateHouseholdMember(
                    household_id: $head->household_id, 
                    family_relationship_type_id: $family_relationship_type_id,
                    gender: $spouse_gender,
                    birthdate: $spouse_birthdate,
                    surname: $head->surname
            );
        }
        return null;       
    }

    /**
     * Generate household head's children
     *
     * @param HouseholdMember $head     Household head
     * @param HouseholdMember $spouse   Household head's spouse (if any)
     * @return integer                  Children count from 0 to 5
     */
    protected function generateChildren(HouseholdMember $head, ?HouseholdMember $spouse): int
    {
        $children_count = $this->randomValueWithDistributionLaw([0=>15, 1 => 30, 2 => 40, 3=> 10, 4=>5]);
                    
        if ($children_count > 0) {
            
            // $children = [];
            
            $father_name =  $head->gender == 'male' 
                                ? $head->name 
                                : (!is_null($spouse) ? $spouse->name : '');

            
            if (!is_null($spouse)) {
                $youngest_parent = ($head->fullAge > $spouse->fullAge) ? $spouse->fullAge : $head->fullAge;
            } else {
                $youngest_parent = $head->fullAge;
            }

            $oldest_child = $youngest_parent - 20;

            for($i=0; $i<$children_count; $i++) {
                
                $child_gender = $this->randomValueWithDistributionLaw(['male' => 50, 'female'  => 50 ]);
                                            
                $child_birthdate = $this->faker->dateTimeBetween("-" . $oldest_child-$i ." years", "-". $oldest_child - 10 - $i ." years");

                $family_relationship_type_id = $child_gender == 'female'
                                                    ?  $this->family_relationships['daughter']  
                                                    :  $this->family_relationships['son'];

                $child = $this->generateHouseholdMember(
                            household_id: $head->household_id,
                            family_relationship_type_id: $family_relationship_type_id,
                            gender: $child_gender,
                            birthdate: $child_birthdate,
                            surname: $head->surname,
                            father_name: $father_name
                        );
            
                // Disabled child
                $disabled = $this->randomValueWithDistributionLaw([true => 5, false  => 95 ]);
                if ($disabled) {
                    $child->setAdditionalParamValue($this->additional_params['child_disabled'], true);
                }
            }
            
        }        
        return $children_count;
    }
  
    /**
     * Generate person surname, name and patronymic
     *
     * @param string $gender           Person sex: male/female
     * @param string $surname       Person surname (if generated person is part of a family, e.g wife, or children etc.)
     * @param string $father_name   Person patronymic will be generate based on $father_name and $gender
     * @return array                ['surname' => '...', 'name' => '...', 'patronymic' => '...']
     */
    protected function generatePerson(string $gender = 'male', string $surname = '', string $father_name = ''): array
    {
        
        if ($surname != '' && $gender == 'female') {
            if (mb_substr($surname, -2) == 'ов') {
                $surname = $surname . 'а';
            } else if (str_ends_with($surname, 'ський') || str_ends_with($surname, 'цький')) {
                $surname = mb_substr($surname, -2) . 'а';
            } else if (mb_substr($surname, -1) == 'н') {
                $surname = $surname . 'а';
            }            
        }


        $person['surname']      = $surname == '' 
                                    ? $this->faker->lastName($gender) 
                                    : $surname;

        $person['name']         = $this->faker->firstName($gender);

        $person['patronymic']   = $father_name == '' 
                                    ? $this->faker->middleName($gender) 
                                    : Patronymic::getPatronymic(father_name: $father_name, gender: $gender);
                                    // : $this->generatePatronymicName(father_name: $father_name, gender: $gender);
        
        return $person;
    }
    
    /**
     * Return person full name
     *
     * @param string $surname       Person's surname
     * @param string $name          Person's name
     * @param string $patronymic    Person's paronymic
     * @return string               Person's full name (Surname Name Patronymic)
     */
    protected function getPersonFullName(string $surname, string $name, string $patronymic): string
    {
        return $surname . " " . $name . " " . $patronymic;
    }

    /**
     * Generate Household with random type
     *
     * @param integer $settlement_id    Settlement Id in which Household will be generated
     * @return Household                Genereted Household
     */
    protected function generateHousehold(int $settlement_id): Household
    {
        $household_type_id = $this->randomValueWithDistributionLaw([1 => 85, 2 => 5, 3 => 2, 4 => 3, 5 => 5]);

        $street_number = rand(0,count($this->streets)-1);
        $address = "вул.," . $this->streets[$street_number][0] . "," . $this->streets[$street_number][1]++ . ",,";

        $household = Household::factory()
                        ->create([
                            'settlement_id'     =>  $settlement_id, 
                            'household_type_id' =>  $household_type_id,
                            'address'           =>  $address,
                            'number'            =>  $this->household_number++,
                            'special_marks'     =>  '', 
                            'additional_data'   =>  '' 
                        ]);
        
        // Set household owner
        if (in_array($household->household_type_id, [3,4])) {
            $gender =  $this->randomValueWithDistributionLaw(['male' => 70, 'female'  => 30 ]);                      
            $owner = $this->getPersonFullName(...$this->generatePerson($gender));              
            $address    = "вул. " . $this->faker->streetName() . ", буд. " . $this->faker->buildingNumber();
            $household->owners()->make([
                'name'      =>  $owner,
                'address'   =>  $address,
            ]);
        }

        // Generate HouseholdHouseYears and HouseholdLandYears
        $years = $this->randomValueWithDistributionLaw([1 => 5, 2 => 10, 3 => 15, 4 => 20, 5 => 50]);

        $last_house_year = HouseholdHouse::factory()
                                ->create([
                                    'household_id'          =>  $household->id,
                                    'year'                  =>  (new DateTime)->format('Y'),                                    
                                ]);
        
        $last_land_year = HouseholdLand::factory()
                                ->create([
                                    'household_id'          =>  $household->id,
                                    'year'                  =>  (new DateTime)->format('Y'),                                    
                                ]);

        for($i=1; $i<=$years-1; $i++) {
            $house_year = $last_house_year->replicate()->fill([
                'year'  => $last_house_year->year - $i
            ]);
            $house_year->save();

            $land_year = $last_land_year->replicate()->fill([
                'year'  => $last_land_year->year - $i
            ]);
            $land_year->save();
        }


        
        

        return $household;

    }

    /**
     * Generate HouseholdMember
     *
     * @param integer $household_id                 Household identificator
     * @param integer $family_relationship_type_id  Family relationship type ID in relation to the household head
     * @param string $gender                        Member gender (male/female)
     * @param DateTime $birthdate                   Member birthdate
     * @param string $surname                       Member surname (use for spouse and/or children)
     * @param string $father_name                   Member patronymic based on this name
     * @return HouseholdMember                      Generated HouseholdMember
     */
    protected function generateHouseholdMember(int $household_id, int $family_relationship_type_id, string $gender = '', DateTime $birthdate, string $surname = '', string $father_name = '' ): HouseholdMember
    {   
        $person = $this->generatePerson(gender: $gender, surname: $surname, father_name: $father_name);

        return HouseholdMember::factory()->create([
                    'household_id'                  =>  $household_id,
                    'surname'                       =>  $person['surname'],
                    'name'                          =>  $person['name'],
                    'patronymic'                    =>  $person['patronymic'],
                    'sex'                           =>  $gender == 'male' ? 'чоловіча' : 'жіноча',
                    'birthdate'                     =>  $birthdate->format('Y-m-d'),
                    'family_relationship_type_id'   =>  $family_relationship_type_id,
                    'employment_information'        =>  null,
                    'work_place_id'                 =>  null,
        ]);
        
    }

    /**
     * Generate birthdate based on another birthdate (spouse, father, etc) and interval +/- years
     * For example, birthdate = 1960-05-05, then $start -5 and $end 5 generate new birthdate year
     * between 1955-05-05 and 1965-05-05
     *
     * @param string $birthdate Base birthdate
     * @param integer $start    Start years invertal
     * @param integer $end      End years interval
     * @return DateTime         Generated birthdate
     */
    protected function generateBirthdateInYearsInverval(string $birthdate, int $start, int $end): DateTime
    {    
        $birthdate = Carbon::createFromFormat('Y-m-d', $birthdate);
        $start_date = $birthdate->copy()->subYears($start);
        $end_date = $birthdate->copy()->addYears($end);        
        return $this->faker->dateTimeBetween($start_date, $end_date);
    }

}
