<?php

namespace App\Http\Requests\API\v1;

use App\Traits\Models\UserRights;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class HouseholdMemberRequest extends FormRequest
{
    use UserRights;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->checkIfUserHasRightsTo('App\Models\HouseholdMember');

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
            'household_id'                  =>  'required|exists:households,id',
            'surname'                       =>  'required|min:3',
            'name'                          =>  'required|min:3',
            'patronymic'                    =>  'required|min:3',
            'sex'                           =>  ['required',  Rule::in(['чоловіча', 'жіноча'])],
            'family_relationship_type_id'   =>  'required|exists:family_relationship_types,id',
            'birthdate'                     =>  'required|date|before_or_equal:today',
            'work_place_id'                 =>  'nullable|exists:work_places,id',
            'employment_information'        =>  'required_with:work_place_id',
            'additional_information'        =>  'nullable|min:3',
            'social_information'            =>  'nullable|min:3',
            'death_date'                    =>  'nullable|date|after_or_equal:birthdate',
            'death_register_number'         =>  'required_with:death_date',
            'death_register_office'         =>  'nullable|min:3',
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
            'surname.required'                      => 'Ви не указали прізвище',
            'surname.min'                           => 'Укажіть не менше ніж :min символа',
            'name.required'                         => 'Ви не указали ім\'я',
            'name.min'                              => 'Укажіть  не менше ніж :min символа',
            'patronymic.required'                   => 'Ви не указали по батькові',
            'patronymic.min'                        => 'Укажіть не менше ніж :min символа',
            'sex.required'                          => 'Ви не указали стать',
            'sex.in'                                => 'Не припустиме значення',
            'birthdate.required'                    => 'Ви не указали дату народження',
            'birthdate.date'                        => 'Потрібен формат YYYY-MM-DD',
            'birthdate.before_or_equal'             => 'Ви указали майбутню дату',
            'family_relationship_type_id.required'  => 'Ви не указали тип стосунків',
            'family_relationship_type_id.exists'    => 'Тип не існує в довіднику або не обран',
            'work_place_id.exists'                  => 'Тип не існує в довіднику або не обран',
            'employment_information.required_with'  => 'Ви не вказали місце роботи і посаду',
            'employment_information.min'            => 'Укажіть не менше ніж :min символа',
            'social_information.min'                => 'Укажіть не менше ніж :min символа',
            'additional_information.min'            => 'Укажіть не менше ніж :min символа',
            // 'land_owned.numeric'                    => 'Укажіть число',
            // 'land_owned.gte'                        => 'Значення повинно бути більше 0',
            // 'land_rented.numeric'                   => 'Укажіть число',
            // 'land_rented.gte'                       => 'Значення повинно бути більше 0',
            // 'land_leased.numeric'                   => 'Укажіть число',
            // 'land_leased.gte'                       => 'Значення повинно бути більше 0',
            'death_register_number.required_with'   => 'Укажіть номер свідоцтва',
            'death_register_office.min'             => 'Укажіть не менше ніж :min символа'
        ];
    }

}
