<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CompoundUniqueIndexValidation;
use App\Traits\Models\UserRights;

class CouncilRequest extends FormRequest
{
    use UserRights;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->checkIfUserHasRightsTo('App\Models\Council');

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
            'community_id'      =>  'required|exists:communities,id',
            'council_type_id'   =>  'required|exists:council_types,id',
            'name'              =>  [
                                        'required',
                                        'min:3',
                                        new CompoundUniqueIndexValidation(
                                            model: 'App\Models\Council',
                                            field: 'community_id',
                                            msg: "Рада с такою назвою вже існує в указаній громаді"
                                        )
                                    ],
            'address'           =>  'required|min:3',
            'koatuu'            =>  ['required', 'regex:/^\d{10}$/i', 'unique:councils,koatuu,' . $this->id],
            'edrpou'            =>  ['required', 'regex:/^\d{8}$/i', 'unique:councils,edrpou,' . $this->id]
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
            'community_id.required'     =>  'Ви не указали громаду',
            'community_id.exists'       =>  'Громада с таким ID не існує',
            'council_type_id.required'  =>  'Ви не указали тип ради',
            'council_type_id.exists'    =>  'Тип ради с таким ID не існує',
            'name.required'             =>  'Ви не вказали назву ради',
            'name.min'                  =>  'Назва ради повинна бути більш ніж :min символів',
            'address.required'          =>  'Ви не указали адрес',
            'address.min'               =>  'Укажіть не менше ніж :min символа',
            'edrpou.required'           =>  'Ви не указали код ЄДРПОУ',
            'edrpou.regex'              =>  'Ви не указали невірний код ЄДРПОУ',
            'edrpou.unique'             =>  'Такий код ЄДРПОУ вже існує',
            'koatuu.required'           =>  'Ви не указали код КОАТУУ',
            'koatuu.regex'              =>  'Ви не указали невірний код КОАТУУ',
            'koatuu.unique'             =>  'Такий код КОАТУУ вже існує',
        ];
    }
}
