<?php

namespace App\Http\Requests\API\v1;

use App\Rules\DistrictUniquePerRegion;
use Illuminate\Foundation\Http\FormRequest;

class DistrictRequest extends FormRequest
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
            'region_id'         =>  'required|exists:regions,id',
            'name'              =>  ['required', 'min:5', new DistrictUniquePerRegion()],
            'center'            =>  'required|min:3'
        ];
    }
}
