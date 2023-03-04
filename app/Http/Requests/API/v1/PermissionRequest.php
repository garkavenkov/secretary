<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'code'          =>  'required|min:3|unique:permissions,code,' . $this->id,
            'name'          =>  'required|min:3|unique:permissions,name,' . $this->id,
            'description'   =>  'required|min:3',
            'error'         =>  'nullable|min:3'
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
            'code.required'         =>  'Ви не вказали код дозволу',
            'code.min'              =>  'Код дозволу повинен бути більш ніж :min символів',
            'code.unique'           =>  'Дозвіл с таким кодом вже існує',
            'name.required'         =>  'Ви не вказали назву дозволу',
            'name.min'              =>  'Назва дозволу повинна бути більш ніж :min символів',
            'name.unique'           =>  'Досвіл с такою назвою вже існує',
            'description.required'  =>  'Ви не вказали опис дозволу',
            'description.min'       =>  'Опис дозволу повинен бути більш ніж :min символів',
            'error.min'             =>  'Помилка дозволу повинна бути більш ніж :min символів',
        ];
    }
}
