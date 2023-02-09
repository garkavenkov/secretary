<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'household_id' => [
            'required' => 'Ви не указали домогосподарство',
            'exists'   => 'Указане домогосподарство відсутне',
        ],
        'year' => [
            'required' => 'Ви не указали рік',
            'integer'  => 'Укажіть числове значення',
            'digits'   => 'Укажіть рік в форматі - 9999',
        ],
        'code' => [
            'required'  => 'Ви не указали код',
            'min'       => 'Укажіть не менше ніж :min символа',
            'exists'    => 'Код не існує',
            'unique'    => 'Такий код вже існує',
        ],
        'name' => [
            'required'  => 'Ви не указали назву',
            'min'       => 'Укажіть не менше ніж :min символа',
            'unique'    => 'Така назва вже існує',
        ],
        'description' => [
            'required'  => 'Ви не указали опис',
            'min'       => 'Укажіть не менше ніж :min символа',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
