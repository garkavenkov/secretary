<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
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
            'name'      =>  'required|min:5|unique:regions,name,' . $this->id,
            'center'    =>  'required|min:3'
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
            'name.required'         =>  'Ви не вказали найменування області',
            'name.min'              =>  'Назва області повинна бути більш ніж :min символів',
            'name.unique'           =>  'Область с таким найменуванням вже існує',
            'center.required'       =>  'Ви не вказали обласний центр',
            'center.min'            =>  'Назва обласного центру повинна бути більш ніж :min символів',
        ];
    }
}
