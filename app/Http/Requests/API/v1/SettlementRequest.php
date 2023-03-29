<?php

namespace App\Http\Requests\API\v1;

use App\Rules\CompoundUniqueIndexValidation;
use App\Traits\Models\UserRights;
use Illuminate\Foundation\Http\FormRequest;

class SettlementRequest extends FormRequest
{
    use UserRights;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->checkIfUserHasRightsTo('App\Models\Settlement');

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
            'council_id'            =>  'required|exists:councils,id',
            'settlement_type_id'    =>  'required|exists:settlement_types,id',
            'name'                  =>  [
                                            'required',
                                            'min:3',
                                            new CompoundUniqueIndexValidation(
                                                model: 'App\Models\Settlement',
                                                field: 'council_id',
                                                msg: "Поселення вже існує в указаній раді"
                                            )
                                        ],
            'inner_code'            =>  [
                                            'required',
                                            'gt:0',
                                            'integer',
                                            new CompoundUniqueIndexValidation(
                                                model: 'App\Models\Settlement',
                                                field: 'council_id',
                                                msg: "Код поселення вже використовується в указаній раді"
                                            )
                                        ],
            'postcode'              =>  ['required', 'regex:/^\d{5}$/i'],
            'katottg'               =>  ['required', 'regex:/^UA\d{17}$/i', 'unique:settlements,katottg,' . $this->id],
        ];
    }

    /**
     * Custom messages for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'council_id.required'           =>  'Ви не вказали міську/сільську раду',
            'council_id.exists'             =>  'Міська/сільська рада не вказана або не існує',
            'settlement_type_id.required'   =>  'Ви не вказали тип населенного пункту',
            'settlement_type_id.exists'     =>  'Тип не вказаний або не існує',
            'name.required'                 =>  'Ви не вказали назву населенного пункту',
            'name.min'                      =>  'Назва населенного пункту повинна бути більш ніж :min символів',
            'inner_code.required'           =>  'Ви не вказали внутрішній код',
            'inner_code.gt'                 =>  'Внутрішній код має бути більше 0',
            'postcode.required'             =>  'Ви не вказали поштовий індекс',
            'postcode.regex'                =>  'Невірний формат індексу',
            'katottg.required'              =>  'Ви не вказали код КАТОТТГ',
            'katottg.regex'                 =>  'Невірний формат коду КАТОТТГ',
            'katottg.unique'                =>  'Такий код КАТОТТГ вже існує'
        ];
    }
}
