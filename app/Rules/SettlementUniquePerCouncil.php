<?php

namespace App\Rules;

use App\Models\Settlement;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class SettlementUniquePerCouncil implements Rule, DataAwareRule
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
        $settlement = Settlement
                        ::where('council_id', $this->data['council_id'])
                        ->where($attribute, $value)
                        ->first();

        if (!is_null($settlement)) {
            if (request()->method() == 'PATCH') {
                return $settlement->id == $this->data['id'] ? true : false;
            }
            $this->msg = "Поселення вже існує в указаній раді";
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
