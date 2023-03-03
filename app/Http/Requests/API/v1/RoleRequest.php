<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'code'          =>  'required|min:3|unique:roles,code,' . $this->id,
            'name'          =>  'required|min:3|unique:roles,name,' . $this->id,
            'description'   =>  'required|min:3',
            'system'        =>  'nullable|boolean'
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
            'code.required'         =>  'Ви не вказали код ролі',
            'code.min'              =>  'Код ролі повинен бути більш ніж :min символів',
            'code.unique'           =>  'Роль с таким кодом вже існує',
            'name.required'         =>  'Ви не вказали назву ролі',
            'name.min'              =>  'Назва ролі повинна бути більш ніж :min символів',
            'name.unique'           =>  'Роль с такою назвою вже існує',
            'description.required'  =>  'Ви не вказали опис ролі',
            'description.min'       =>  'Опис ролі повинен бути більш ніж :min символів',
        ];
    }
}
