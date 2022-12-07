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
            'place_work_id'             =>  'required|exists:places_work,id',
            'employment_information'    =>  'nullable|min:3'
        ];
    }
}
