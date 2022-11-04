<?php

namespace App\Rules;

use App\Models\Council;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class CouncilUniquePerCommunity implements Rule, DataAwareRule
{
    private $msg;
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
        $council = Council
                    ::where('community_id', $this->data['community_id'])
                    ->where($attribute, $value)
                    ->first();

        if (!is_null($council)) {
            if (request()->method() == 'PATCH') {
                return $council->id == $this->data['id'] ? true : false;
            }
            $this->msg = "Рада с такою назвою вже існує в указаній громаді";
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
        return $this->msg;
    }
}
