<?php

namespace App\Http\Requests\API\v1;

use App\Traits\Models\UserRights;
use Illuminate\Foundation\Http\FormRequest;

class WorkPlaceRequest extends FormRequest
{
    use UserRights;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->checkIfUserHasRightsTo('App\Models\WorkPlace');

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
            'name'  =>  'required|min:3|unique:work_places,name'
        ];
    }

    /**
     * Custom messages for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'                 =>  'Ви не вказали назву коду місця роботи',
            'name.min'                      =>  'Назва коду місця роботи повинна бути більш ніж :min символів',
            'name.unique'                   =>  'Код с такою назвою вже існує',
        ];
    }
}
