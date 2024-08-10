<?php
return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'admin',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\admin::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'expire' => 60,
        ],
        'admin' => [
            'provider' => 'admin',
            'expire' => 15,
        ],
    ],

    'password_timeout' => 10800,
];
