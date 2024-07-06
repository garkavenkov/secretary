<?php

namespace App\Http\Requests\API\v1;

use Illuminate\Validation\Rule;
use App\Traits\Models\UserRights;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CompoundUniqueIndexValidation;

class AdditionalParamConditionRequest extends FormRequest
{
    use UserRights;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->checkIfUserHasRightsTo('App\Models\AdditionalParamCondition');

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
            'param_id'      =>  'required|exists:additional_params,id',
            'attribute_id'  =>  'required|exists:model_attributes,id',
            'condition'     =>  [
                                    'required',
                                    Rule::in(['>=','>','=','!=','<=','<']),
                                    new CompoundUniqueIndexValidation(
                                        model: 'App\Models\AdditionalParamCondition',
                                        field: 'attribute_id',
                                        msg: 'Дана умова вже існує для цього атрибуту'
                                    )
                                ],
            'value'         =>  'required',
        ];
    }
}
