<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class HouseholdMemberRequest extends FormRequest
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
            'household_id'              =>  'required|exists:households,id',
            'surname'                   =>  'required|min:3',
            'name'                      =>  'required|min:3',
            'patronymic'                =>  'required|min:3',
            'sex'                       =>  ['required',  Rule::in(['чоловіча', 'жіноча'])],
            'family_relationship_id'    =>  'required|exists:family_relationships,id',
            'birthday'                  =>  'required|date|before_or_equal:today',
            'work_place_id'             =>  'nullable|exists:work_places,id',
            'employment_information'    =>  'nullable|min:3'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'surname.required'                  => 'Ви не указали прізвище',
            'surname.min'                       => 'Укажіть не менше ніж :min символа',
            'name.required'                     => 'Ви не указали ім\'я',
            'name.min'                          => 'Укажіть  не менше ніж :min символа',
            'patronymic.required'               => 'Ви не указали по батькові',
            'patronymic.min'                    => 'Укажіть не менше ніж :min символа',
            'sex.required'                      => 'Ви не указали стать',
            'sex.in'                            => 'Не припустиме значення',
            'birthday.required'                 => 'Ви не указали дату народження',
            'birthday.date'                     => 'Потрібен формат YYYY-MM-DD',
            'birthday.before_or_equal'          => 'Ви указали майбутню дату',
            'family_relationship_id.required'   => 'Ви не указали тип стосунків',
            'family_relationship_id.exists'     => 'Тип не існує в довіднику або не обран',
            'work_place_id.exists'              => 'Тип не існує в довіднику або не обран',
            'employment_information.min'        => 'Укажіть не менше ніж :min символа',
        ];
    }

}
