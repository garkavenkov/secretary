<?php

namespace App\Http\Requests\API\v1;

use App\Traits\Models\UserRights;
use Illuminate\Foundation\Http\FormRequest;

class HouseholdOwnerRequest extends FormRequest
{
    use UserRights;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->checkIfUserHasRightsTo('App\Models\HouseholdOwner');

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
            'household_id'      =>  'required|exists:households,id',
            'name'              =>  'required|min:3',
            'address'           =>  'required|min:3',
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
            'name.required'        => 'Ви не указали власника',
            'name.min'             => 'Укажіть не менше ніж :min символа',
            'address.required'     => 'Ви не указали адресу власника',
            'address.min'          => 'Укажіть не менше ніж :min символа',
        ];
    }
}
