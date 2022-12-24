<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CompoundUniqueIndexValidation;

class HouseholdHouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'household_id'      =>  'required|exists:households,id',
            'year'                  =>  [
                                            'required',
                                            'integer',
                                            'digits:4',
                                            new CompoundUniqueIndexValidation(
                                                model: 'App\Models\HouseholdHouse',
                                                field: 'household_id',
                                                msg: "Дані на вказаний рік вже існують"
                                            )
                                        ],
            'total_area'            =>  'required|numeric|gt:0',
            'total_living_area'     =>  'required|numeric|gt:0|lte:total_area',
            'living_area'           =>  'required|numeric|gt:0|lte:total_living_area',
            'room_count'            =>  'required|numeric|gte:0',
            'total_non_living_area' =>  'required|numeric|gte:0',
            'water_supply'          =>  'nullable|boolean',
            'hot_water_supply'      =>  'nullable|boolean',
            'sewage'                =>  'nullable|boolean',
            'central_heating'       =>  'nullable|boolean',
            'individual_heating'    =>  'nullable|boolean',
            'furnace_heating'       =>  'nullable|boolean',
            'natural_gas'           =>  'nullable|boolean',
            'liquefied_gas'         =>  'nullable|boolean',
            'electric_stove'        =>  'nullable|boolean',
        ];
    }
}
