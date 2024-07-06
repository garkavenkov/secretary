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
            'required' => 'Ви не вказали домогосподарство',
            'exists'   => 'Вказане домогосподарство відсутне',
        ],
        'year' => [
            'required'  => 'Ви не вказали рік',
            'integer'   => 'Вкажіть числове значення',
            'digits'    => 'Вкажіть рік в форматі - 9999',
        ],
        'code' => [
            'required'  => 'Ви не вказали код',
            'min'       => 'Вкажіть не менше ніж :min символа',
            'exists'    => 'Код не існує',
            'unique'    => 'Такий код вже існує',
        ],
        'name' => [
            'required'  => 'Ви не вказали назву',
            'min'       => 'Вкажіть не менше ніж :min символа',
            'unique'    => 'Така назва вже існує',
        ],
        'email' => [
            'required'  => 'Ви не вказали адресу елєктронної пошти',
            'email'     => 'Вкажіть дійсну адресу електронної пошти',
        ],
        'description' => [
            'required'  => 'Ви не вказали опис',
            'min'       => 'Вкажіть не менше ніж :min символа',
        ],
        'position' => [
            'min'       => 'Вкажіть не менше ніж :min символа',
        ],
        'password' => [
            'required'  => 'Ви не вказали пароль',
            'min'       => 'Вкажіть не менше ніж :min символів',
            'confirmed' => 'Підтвердження пароля не збігається'
        ],
        'attribute_id' => [
            'required'  => 'Ви не вказали атрибут',
            'exists'    => 'Атрибут не існує',
        ],
        'condition' => [
            'required'  => 'Ви не вказали умову',
            'in'        => 'Неприпустима умова',
        ],
        'value' => [
            'required'  => 'Ви не вказали значення',
        ]
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
