<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Foundation\Http\FormRequest;

class AdditionalParamValueTypeRequest extends FormRequest
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
            'code'          =>  'required|min:3|unique:additional_param_value_types,code,' .  $this->id,
            'name'          =>  'required|min:3|unique:additional_param_value_types,name,' .  $this->id,
            'description'   =>  'required|min:3',
        ];
    }
}
