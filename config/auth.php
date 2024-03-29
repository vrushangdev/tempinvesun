<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'callcenter' => [
            'driver' => 'session',
            'provider' => 'callcenters',
        ],
        'lead_assistant' => [
            'driver' => 'session',
            'provider' => 'lead_assistants',
        ],
        'tech_partner' => [
            'driver' => 'session',
            'provider' => 'tech_partners',
        ],
        'retailer' => [
            'driver' => 'session',
            'provider' => 'retailers',
        ],
        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        'callcenters' => [
            'driver' => 'eloquent',
            'model' => App\Models\CallCenterAgent::class,
        ],
        'lead_assistants' => [
            'driver' => 'eloquent',
            'model' => App\Models\LeadAssistant::class,
        ],
        'tech_partners' => [
            'driver' => 'eloquent',
            'model' => App\Models\TechPartner::class,
        ],
        'retailers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Retailer::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'admins' => [
            'provider' => 'admins',
            'email' => 'admin.auth.emails.password',
            'table' => 'admin_password_resets',
            'expire' => 60,
        ],
        'callcenters' => [
            'provider' => 'callcenters',
            'email' => 'callcenter.auth.emails.password',
            'table' => 'callcenter_password_resets',
            'expire' => 60,
        ],
        'lead_assistants' => [
            'provider' => 'lead_assistants',
            'email' => 'lead_assistant.auth.emails.password',
            'table' => 'lead_assistants_password_resets',
            'expire' => 60,
        ],
        'tech_partners' => [
            'provider' => 'tech_partners',
            'email' => 'tech_partner.auth.emails.password',
            'table' => 'tech_partners_password_resets',
            'expire' => 60,
        ],
        'retailers' => [
            'provider' => 'retailers',
            'email' => 'retailer.auth.emails.password',
            'table' => 'retailer_password_resets',
            'expire' => 60,
        ],
    ],

];
