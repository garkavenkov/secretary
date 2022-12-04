<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class HouseholdRequest extends FormRequest
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
            'community_id'      =>  'required|exists:communities,id',
            'household_type_id' =>  'required|exists:household_types,id',
            'address'           =>  'required|min:3',
            'special_marks'     =>  'nullable|min:3',
            'additional_data'   =>  'nullable|min:3'
        ];
    }
}
