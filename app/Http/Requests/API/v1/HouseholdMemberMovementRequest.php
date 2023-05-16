<?php

namespace App\Http\Requests\API\v1;

use App\Traits\Models\UserRights;
use Illuminate\Foundation\Http\FormRequest;

class HouseholdMemberMovementRequest extends FormRequest
{
    use UserRights;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->checkIfUserHasRightsTo('App\Models\HouseholdMemberMovement');

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
            'movement_type_id'      =>  'required|exists:movement_types,id',
            'date'                  =>  'required|date',
            'comment'               =>  'required|min:3'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'member_id.required'                    => 'Ви не указали члена домогосподарства',
            'member_id.exists'                      => 'Указаний член домогосподарства не існує',
            'movement_type_id.required'             => 'Ви не указали тип події',
            'movement_type_id.exists'               => 'Указаний подія не уснує в довіднику',
            'date.required'                         => 'Ви не указали дату події',
            'date.date'                             => 'Укажіть дату в форматі "РРРР-ММ-ДД"',
            'comment.required'                      => 'Ви не указали примітку',
            'comment.min'                           => 'Укажіть не менше ніж :min символа',
        ];
    }
}
