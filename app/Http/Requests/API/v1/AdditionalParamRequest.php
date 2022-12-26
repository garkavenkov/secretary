<?php

namespace App\Http\Requests\API\v1;

use App\Rules\CompoundUniqueIndexValidation;
use Illuminate\Foundation\Http\FormRequest;

class AdditionalParamRequest extends FormRequest
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
            'category_id'   =>  'required|exists:additional_param_categories,id',
            'code'          =>  [
                                    'required',
                                    'min:3',
                                    new CompoundUniqueIndexValidation(
                                        model: 'App\Models\AdditionalParam',
                                        field: 'category_id',
                                        msg: 'Додатковий параметр с таким кодом вже існує в указаній категорії'
                                    )
                                ],
            'name'          =>  [
                                    'required',
                                    'min:3',
                                    new CompoundUniqueIndexValidation(
                                        model: 'App\Models\AdditionalParam',
                                        field: 'category_id',
                                        msg: 'Додатковий параметр с такою назвою вже існує в указаній категорії'
                                    )
                                ],
        ];
    }
}
