<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class HouseholdTypeRequest extends FormRequest
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
            'name'  =>  'required|min:3|unique:household_types,name'
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
            'name.required'                 =>  'Ви не вказали назву типу об\'єкта погосподарського обліку',
            'name.min'                      =>  'Назва типу типу об\'єкта повинна бути більш ніж :min символів',
            'name.unique'                   =>  'Тип об\'єкта с такою назвою вже існує',
        ];
    }
}
