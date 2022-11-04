<?php

namespace App\Http\Requests\API\v1;

use App\Rules\CompoundUniqueIndexValidation;
use Illuminate\Foundation\Http\FormRequest;

class SettlementRequest extends FormRequest
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
            'council_id'            =>  'required|exists:councils,id',
            'settlement_type_id'    =>  'required|exists:settlement_types,id',
            'name'                  =>  [
                                            'required',
                                            'min:3',
                                            new CompoundUniqueIndexValidation(
                                                model: 'App\Models\Settlement',
                                                field: 'council_id',
                                                msg: "Поселення вже існує в указаній раді"
                                            )
                                        ],
            'postcode'              =>  ['required', 'regex:/^\d{5}$/i']
        ];
    }
}
