<?php

namespace App\Http\Requests\API\v1;

use App\Rules\CompoundUniqueIndexValidation;
use App\Traits\Models\UserRights;
use Illuminate\Foundation\Http\FormRequest;

class HouseholdRequest extends FormRequest
{
    use UserRights;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->checkIfUserHasRightsTo('App\Models\Household');

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
            'settlement_id'     =>  'required|exists:settlements,id',
            'household_type_id' =>  'required|exists:household_types,id',
            'address'           =>  [
                                        'required',
                                        'min:3',
                                        new CompoundUniqueIndexValidation(
                                            model: 'App\Models\Household',
                                            field: 'settlement_id',
                                            msg: "Домогосподарство з такою адресою вже існує в указаному населеному пункті"
                                        )
                                    ],
            'number'            =>  [
                                        'required',
                                        'numeric',
                                        'gt:0',
                                        new CompoundUniqueIndexValidation(
                                            model: 'App\Models\Household',
                                            field: 'settlement_id',
                                            // msg: "Домогосподарство з таким номером вже існує в указаному населеному пункті"
                                            msg: 'Номер вже існує'
                                        )
                                    ],
            'special_marks'     =>  'nullable|min:3',
            'additional_data'   =>  'nullable|min:3'
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
            'address.required'              => 'Ви не указали адрес',
            'address.min'                   => 'Укажіть не менше ніж :min символа',
            'special_marks.min'             => 'Укажіть  не менше ніж :min символа',
            'additional_data.min'           => 'Укажіть не менше ніж :min символа',
            'settlement_id.required'        => 'Ви не указали населений пункт',
            'settlement_id.exists'          => 'Населений пункт не існує в довіднику або не обран',
            'household_type_id.required'    => 'Ви не указали тип об\'єкта',
            'household_type_id.exists'      => 'Тип об\'єкта не існує в довіднику або не обран',
            'number.required'               => 'Ви не указали номер',
            'number.numeric'                => 'Укажіть число',
            'number.gt'                     => 'Номер меньше 1',
        ];
    }
}
