<?php

namespace App\Rules;

use App\Models\District;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

use function PHPUnit\Framework\isNull;

class DistrictUniquePerRegion implements Rule, DataAwareRule
{
    private $message = '';
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
        $district = District
                        ::where('region_id', $this->data['region_id'])
                        ->where($attribute, $value)
                        ->first();

        if(!is_null($district)) {
            if (request()->method() == 'PATCH') {
                return $district->id == $this->data['id'] ? true : false;
            }
            $this->msg = 'Такий район вже існує в указаній області';
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
