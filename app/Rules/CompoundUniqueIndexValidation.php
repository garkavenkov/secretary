<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;

class CompoundUniqueIndexValidation implements Rule, DataAwareRule
{
    private $msg;
    private $model;
    private $field;
    protected $data = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $model, string $field, string $msg)
    {
        $this->model = $model;
        $this->field = $field;
        $this->msg   = $msg;
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
        $entity = $this->model::query()
                    ->when(str_contains($this->field, ','), function($q) {
                        
                        $fields = explode(',',$this->field);
                        $sql = "";
                        $values = [];
                        $fields_count = count($fields);

                        for($i = 0; $i< $fields_count; $i++) {
                            $sql .= $fields[$i] . " = ? ";
                            if ($i != $fields_count -1) {
                                $sql .= " and ";
                            }
                            $values[] = $this->data[$fields[$i]];
                        }
                        
                        $q->whereRaw($sql, $values);
                        
                    }, function($q) {

                        $q->where($this->field, $this->data[$this->field]);

                    })
                    ->where($attribute, $value)
                    ->first();
        
        if (!is_null($entity)) {
            if (request()->method() == 'PATCH') {
                return $entity->id == $this->data['id'] ? true : false;
            }
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
