<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CompoundUniqueIndexValidation;

class CouncilRequest extends FormRequest
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
            'council_type_id'   =>  'required|exists:council_types,id',
            'name'              =>  [
                                        'required',
                                        'min:3',
                                        new CompoundUniqueIndexValidation(
                                            model: 'App\Models\Council',
                                            field: 'community_id',
                                            msg: "Рада с такою назвою вже існує в указаній громаді"
                                        )
                                    ],
            'address'           =>  'required|min:3',
            'koatuu'            =>  ['required', 'regex:/^\d{10}$/i', 'unique:councils,koatuu,' . $this->id],
            'edrpou'            =>  ['required', 'regex:/^\d{8}$/i', 'unique:councils,edrpou,' . $this->id]
        ];
    }
}
