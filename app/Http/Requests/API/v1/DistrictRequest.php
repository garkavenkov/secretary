<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CompoundUniqueIndexValidation;

class DistrictRequest extends FormRequest
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
            'region_id'         =>  'required|exists:regions,id',
            'name'              =>  [
                                        'required',
                                        'min:5',
                                        new CompoundUniqueIndexValidation(
                                            model: 'App\Models\District',
                                            field: 'region_id',
                                            msg: "Такий район вже існує в указаній області"
                                        )
                                    ],
            'center'            =>  'required|min:3'
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
            'name.required'         =>  'Ви не вказали найменування району',
            'name.min'              =>  'Назва району повинна бути більш ніж :min символів',
            'center.required'       =>  'Ви не вказали андміністративний центр',
            'center.min'            =>  'Назва адміністратитного центру повинна бути більш ніж :min символів',
        ];
    }
}
