<?php

namespace App\Http\Requests\API\v1;

use App\Rules\CommunityUniquePerDistrict;
use Illuminate\Foundation\Http\FormRequest;

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
            'name'          =>  ['required', 'min:3', new CommunityUniquePerDistrict()],
            'address'       =>  'required|min:3',
            'koatuu'        =>  ['required', 'regex:/^\d{10}$/i', 'unique:communities,koatuu,' . $this->id],
            'edrpou'        =>  ['required', 'regex:/^\d{8}$/i',  'unique:communities,edrpou,' . $this->id]
        ];
    }
}
