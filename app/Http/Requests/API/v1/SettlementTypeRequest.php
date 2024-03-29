<?php

namespace App\Http\Requests\API\v1;

use App\Traits\Models\UserRights;
use Illuminate\Foundation\Http\FormRequest;

class SettlementTypeRequest extends FormRequest
{
    use UserRights;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->checkIfUserHasRightsTo('App\Models\SettlementType');

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
            'name'  =>  'required|min:3|unique:settlement_types,name'
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
            'name.required'                 =>  'Ви не вказали назву типу населенного пункту',
            'name.min'                      =>  'Назва типу населенного пункту повинна бути більш ніж :min символів',
            'name.unique'                   =>  'Тип с такою назвою вже існує',
        ];
    }
}
