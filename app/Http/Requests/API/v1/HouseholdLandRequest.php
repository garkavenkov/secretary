<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CompoundUniqueIndexValidation;

class HouseholdLandRequest extends FormRequest
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
            'year'              =>  [
                                        'required',
                                        'integer',
                                        'digits:4',
                                        new CompoundUniqueIndexValidation(
                                            model: 'App\Models\HouseholdLand',
                                            field: 'household_id',
                                            msg: "Дані на вказаний рік вже існують"
                                        )
                                    ],
            'maintenance'           =>  'nullable|numeric|gte:0',
            'personal_agriculture'  =>  'nullable|numeric|gte:0',
            'commercial_agriculture'=>  'nullable|numeric|gte:0',
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
            'maintenance.numeric'                   => 'Укажіть числове значення',
            'maintenance.gte'                       => 'Значення не може бути від’ємним',

            'personal_agriculture.numeric'          => 'Укажіть числове значення',
            'personal_agriculture.gte'              => 'Значення не може бути від’ємним',

            'commercial_agriculture.numeric'        => 'Укажіть числове значення',
            'commercial_agriculture.gte'            => 'Значення не може бути від’ємним',
        ];
    }
}
