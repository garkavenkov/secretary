<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class FamilyRelationshipRequest extends FormRequest
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
            'name'  =>  'required|min:3|unique:family_relationships,name'
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
            'name.required'                 =>  'Ви не вказали назву типу родинних відносин',
            'name.min'                      =>  'Назва типу родинних відносин повинна бути більш ніж :min символів',
            'name.unique'                   =>  'Тип родинних відносин с такою назвою вже існує',
        ];
    }
}
