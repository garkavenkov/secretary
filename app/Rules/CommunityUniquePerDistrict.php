<?php

namespace App\Rules;

use App\Models\Community;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class CommunityUniquePerDistrict implements Rule, DataAwareRule
{

    private $msg = '';
    protected $data = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $community = Community
                        ::where('district_id', $this->data['district_id'])
                        ->where($attribute, $value)
                        ->first();

        if(!is_null($community)) {
            if (request()->method() == 'PATCH') {
                return $community->id == $this->data['id'] ? true : false;
            }
            $this->msg = 'Громада с такою назвою вже існує в указанному районі';
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
