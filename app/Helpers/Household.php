<?php

use DeclensionUkrainian\Toponym;

/**
 * Generate household short address.
 * e.g: "вул. Свободи, буд. 5, корп. 3, кв. 4
 *
 * @return string
 */
function generateHouseholdShortAddress(string $address): string
{
    $parts = explode(',', $address);
    $address = "$parts[0] $parts[1], буд. $parts[2]";

    // корпус
    $address = $address . ($parts[3] !== '' ? ", корп. $parts[3]" : "");

    // квартира
    $address = $address . ($parts[4] !== '' ? ", кв. $parts[4]" : "");

    return $address;
}


/**
 *  Generate household full address. 
 *  Which extends short address adding district and region name
 * 
 *  @return string
 */
function generateHouseholdFullAddress(string $address, string $settlement, string $settlement_type, string $district, string $region): string
{
    $settlement_type = mb_strtolower($settlement_type);

    $district = explode(' ', $district);
    $district = Toponym::inGenetive(['name' => $district[0], 'type' => $district[1]]);

    $region = explode(' ', $region);
    $region = Toponym::inGenetive(['name' => $region[0], 'type' => $region[1]]);

    return generateHouseholdShortAddress($address) . ", $settlement_type $settlement, $district, $region";
}

/**
 * Generate household number in ss-nnnn-t format
 * where:   
 *      -ss     - settlement inner code
 *      -nnnn   - household number through settlement, 1,2,3....etc  
 *      -t      - household type [1..5]
 *
 * @param integer $settlement_inner_code    Settlement inner code (e.g.: 1,2,...)
 * @param integer $household_number         Household number
 * @param integer $household_type_id        Household type (1,2,3,4,5)
 * 
 * @return string
 */
function generateHouseholdNumber(int $settlement_inner_code, int $household_number, int $household_type_id): string
{
    return  str_pad($settlement_inner_code, 2, '0', STR_PAD_LEFT)
            . '-'
            . str_pad($household_number, 4, '0', STR_PAD_LEFT)
            . '-'
            . $household_type_id;
}