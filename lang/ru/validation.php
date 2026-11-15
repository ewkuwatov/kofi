<?php

return [
    'accepted' => 'Поле :attribute нужно принять.',
    'array' => 'Поле :attribute должно быть списком.',
    'email' => 'Укажите корректный адрес электронной почты.',
    'in' => 'Выберите одно из доступных значений для поля :attribute.',
    'integer' => 'Поле :attribute должно быть целым числом.',
    'max' => [
        'array' => 'В поле :attribute должно быть не больше :max элементов.',
        'file' => 'Размер файла :attribute не может превышать :max килобайт.',
        'numeric' => 'Значение поля :attribute не может быть больше :max.',
        'string' => 'Поле :attribute не может быть длиннее :max символов.',
    ],
    'min' => [
        'array' => 'В поле :attribute должно быть не меньше :min элементов.',
        'file' => 'Размер файла :attribute должен быть не меньше :min килобайт.',
        'numeric' => 'Значение поля :attribute должно быть не меньше :min.',
        'string' => 'Поле :attribute должно содержать не меньше :min символов.',
    ],
    'required' => 'Заполните поле :attribute.',
    'string' => 'Поле :attribute должно быть текстом.',
    'attributes' => [
        'customer_name' => 'имя',
        'phone' => 'номер телефона',
        'email' => 'электронная почта',
        'pickup_slot' => 'время самовывоза',
        'comment' => 'пожелания',
        'quantities' => 'количество',
    ],
];
