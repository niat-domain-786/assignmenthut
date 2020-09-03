<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Messenger Default User Model
    |--------------------------------------------------------------------------
    |
    | This option defines the default User model.
    |
    */

    'user' => [
        'model' => 'App\User'
    ],

    /*
    |--------------------------------------------------------------------------
    | Messenger Pusher Keys
    |--------------------------------------------------------------------------
    |
    | This option defines pusher keys.
    |
    */

    'pusher' => [
        'app_id'     => '1015248',
        'app_key'    => '26b2687fdc9802cbce04',
        'app_secret' => 'bd36006bc5b922b859b0',
        'options' => [
            'cluster'   => 'ap2',
            'encrypted' => true
        ]
    ],
];
