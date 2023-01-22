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
            'total_living_area'     =>  'required|numeric|lte:total_area|gt:0',
            'living_area'           =>  'required|numeric|lte:total_living_area|gt:0',
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

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [

            'total_area.required'                   => 'Ви не указали загальну площу',
            'total_area.numeric'                    => 'Укажіть числове значення',
            'total_area.gt'                         => 'Загальна площа повинна бути більше 0',

            'total_living_area.required'            => 'Ви не указали загальну площу житлових приміщень',
            'total_living_area.numeric'             => 'Укажіть числове значення',
            'total_living_area.lte'                 => 'Загальна площа житлових приміщень більша ніж "Загальна площа"',
            'total_living_area.gt'                  => 'Загальна площа повинна бути більше 0',

            'living_area.required'                  => 'Ви не указали житлову площу ',
            'living_area.numeric'                   => 'Укажіть числове значення',
            'living_area.lte'                       => 'Житлова площа більша ніж "Загальна площа житлових приміщень"',
            'living_area.gt'                        => 'Житлова площа повинна бути більше 0',

            'room_count.required'                   => 'Ви не указали кількість житлових кімнат',
            'room_count.numeric'                    => 'Укажіть числове значення',
            'room_count.gte'                        => 'Кількість житлових кімнат не може бути від\'ємною',

            'total_non_living_area.required'        => 'Ви не указали загальну площу нежитлових будівель',
            'total_non_living_area.numeric'         => 'Укажіть числове значення',
            'total_non_living_area.gte'             => 'Загальна площа нежитлових будівель не може бути від\'ємною',

        ];
    }
}
