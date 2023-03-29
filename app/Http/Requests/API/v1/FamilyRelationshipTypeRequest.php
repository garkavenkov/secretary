<?php

namespace App\Http\Requests\API\v1;

use App\Traits\Models\UserRights;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FamilyRelationshipTypeRequest extends FormRequest
{
    use UserRights;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->checkIfUserHasRightsTo('App\Models\FamilyRelationshipType');

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
            'name'  =>  'required|min:3|unique:family_relationship_types,name',
            'sex'   =>  ['nullable', Rule::in(['чоловіча', 'жіноча'])]
        ];
    }
}
