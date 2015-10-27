<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default'     => 'main',
    /*
    |--------------------------------------------------------------------------
    | Lta Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like. Note that the 3 supported authentication methods are:
    | "application", "password", and "token".
    |
    */

    'connections' => [

        'main'        => [
            'accountKey'   => 'your-account-key',
            'uniqueUserId' => 'your-unique-user-id',
            'method'       => 'token',
            // 'baseUrl' => 'https://api.github.com/',
            // 'version' => 'v3',
        ],
        'alternative' => [
            'clientId'     => 'your-client-id',
            'clientSecret' => 'your-client-secret',
            'method'       => 'application',
            // 'baseUrl'      => 'https://api.github.com/',
            // 'version'      => 'v3',
        ],
        'other'       => [
            'username' => 'your-username',
            'password' => 'your-password',
            'method'   => 'password',
            // 'baseUrl'  => 'https://api.github.com/',
            // 'version'  => 'v3',
        ],

    ],

];
