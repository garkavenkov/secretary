<?php

namespace App\Http\Requests\API\v1;

use App\Traits\Models\UserRights;
use Illuminate\Foundation\Http\FormRequest;

class AdditionalParamCategoryRequest extends FormRequest
{
    use UserRights;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->checkIfUserHasRightsTo('App\Models\AdditionalParamCategory');

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
            'code'  =>  'required|min:3|unique:additional_param_categories,code,'.$this->id,
            'name'  =>  'required|min:3|unique:additional_param_categories,name,'.$this->id
        ];
    }
}
