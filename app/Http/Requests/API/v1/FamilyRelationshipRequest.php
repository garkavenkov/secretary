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
            'member_id'             =>  'required|exists:household_members,id',
            'relationship_type_id'  =>  'required|exists:family_relationship_types,id',
            'relative_id'           =>  'required|exists:household_members,id|different:member_id',
        ];
    }
}
