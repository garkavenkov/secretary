<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CompoundUniqueIndexValidation;

class CommunityRequest extends FormRequest
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
            'district_id'   =>  'required|exists:districts,id',
            'name'          =>  [
                                    'required',
                                    'min:3',
                                    new CompoundUniqueIndexValidation(
                                        model: 'App\Models\Community',
                                        field: 'district_id',
                                        msg: 'Громада с такою назвою вже існує в указанному районі'
                                    )

                                ],
            'address'       =>  'required|min:3',
            'koatuu'        =>  ['required', 'regex:/^\d{10}$/i', 'unique:communities,koatuu,' . $this->id],
            'edrpou'        =>  ['required', 'regex:/^\d{8}$/i',  'unique:communities,edrpou,' . $this->id]
        ];
    }
}
