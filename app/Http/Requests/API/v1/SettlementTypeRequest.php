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
            'name'          =>  'required|min:3|unique:settlement_types,name,' . $this->id,
            'abbreviation'  =>  'required|min:2|unique:settlement_types,abbreviation,' . $this->id
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
            'name.min'                      =>  'Назва типу населенного пункту повинна бути більш ніж 2 символа',
            'name.unique'                   =>  'Тип с такою назвою вже існує',
            'abbreviation.required'         =>  'Ви не вказали абревіатуру типу населенного пункту',
            'abbreviation.min'              =>  'Абревіатура типу населенного пункту повинна бути більш ніж 1 символ',
            'abbreviation.unique'           =>  'Тип с такою абревіатурою вже існує',
        ];
    }
}
