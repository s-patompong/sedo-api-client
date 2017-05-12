<?php

return [

    'username' => env('SEDO_USERNAME'),
    'password' => env('SEDO_PASSWORD'),
    'sign_key' => env('SEDO_SIGN_KEY'),
    'partner_id' => env('SEDO_PARTNER_ID'),

    'timeout' => env('SEDO_TIMEOUT', 30),
    'wsdl' => env('SEDO_WSDL', 'https://api.sedo.com/api/sedointerface.php?wsdl'),

    'log' => env('SEDO_LOG', false),
    'log_path' => env('SEDO_LOG_PATH'),

];