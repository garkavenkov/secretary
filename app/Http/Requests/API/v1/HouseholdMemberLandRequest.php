<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CompoundUniqueIndexValidation;
use App\Traits\Models\UserRights;

class HouseholdMemberLandRequest extends FormRequest
{
    use UserRights;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->checkIfUserHasRightsTo('App\Models\HouseholdMemberLand');

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
            'member_id'             =>  'required|exists:household_members,id',
            'year'                  =>  [
                                            'required',
                                            'integer',
                                            'digits:4',
                                            new CompoundUniqueIndexValidation(
                                                model: 'App\Models\HouseholdMemberLand',
                                                field: 'member_id',
                                                msg: "Дані на вказаний рік вже існують"
                                            )
                                        ],
            'maintenance'           =>  'nullable|numeric|gte:0',
            'personal_agriculture'  =>  'nullable|numeric|gte:0',
            'land_share'            =>  'nullable|numeric|gte:0',
            'property_share'        =>  'nullable|numeric|gte:0',
            'hay_cutting'           =>  'nullable|numeric|gte:0',
            'pastures'              =>  'nullable|numeric|gte:0',
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
            'maintenance.numeric'                   => 'Укажіть числове значення',
            'maintenance.gte'                       => 'Значення не може бути від’ємним',

            'personal_agriculture.numeric'          => 'Укажіть числове значення',
            'personal_agriculture.gte'              => 'Значення не може бути від’ємним',

            'land_share.numeric'                    => 'Укажіть числове значення',
            'land_share.gte'                        => 'Значення не може бути від’ємним',

            'property_share.numeric'                => 'Укажіть числове значення',
            'property_share.gte'                    => 'Значення не може бути від’ємним',

            'hay_cutting.numeric'                   => 'Укажіть числове значення',
            'hay_cutting.gte'                       => 'Значення не може бути від’ємним',

            'pastures.numeric'                      => 'Укажіть числове значення',
            'pastures.gte'                          => 'Значення не може бути від’ємним',
        ];
    }

}
