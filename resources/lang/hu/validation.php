<?php

return [
    'required' => 'A(z) :attribute mező kitöltése kötelező.',
    'string' => 'A(z) :attribute szövegnek kell lennie.',
    'max' => [
        'string' => 'A(z) :attribute nem lehet nagyobb, mint :max karakter.'
    ],
    'min' => [
        'string' => 'A(z) :attribute legalább :min karakter hosszú kell legyen.'
    ],
    'email' => 'A(z) :attribute nem érvényes.',
    'unique' => 'A(z) :attribute már foglalt.',
    'confirmed' => 'A jelszavak nem egyeznek.',
    'regex' => 'A(z) :attribute mező formátuma érvénytelen.',
    'exists' => 'A(z) :attribute nem lézetik',
    'mimes' => 'A(z) :attribute -nak képnek kell lennie. Csak a következő formátumok engedélyezettek: :values.',
    'url' => 'A(z) :attribute -nak valid URL-nek kell lennie',
    'dimensions' => 'A :attribute nem jó méretű. Minimum 100X100 pixel méretűnek kell lennie.',

    'attributes' => [
        'name' => 'név',
        'email' => 'e-mail cím',
        'password' => 'jelszó',
        'first_name' => 'keresztnév',
        'last_name' => 'családnév',
        'company_id' => 'cég',
        'phone_number' => 'telefonszám',
        'logo_image' => 'céglogó',
        'website_url' => 'weboldal',
    ],
];
