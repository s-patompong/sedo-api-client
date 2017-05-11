<?php

return [

    'username' => env('SEDO_USERNAME'),
    'password' => env('SEDO_PASSWORD'),
    'partnerid' => env('SEDO_PARTNER_ID'),
    'signkey' => env('SEDO_SIGN_KEY'),

    'timeout' => env('SEDO_TIMEOUT', 30),
    'wsdl' => env('SEDO_WSDL', 'https://api.sedo.com/api/sedointerface.php?wsdl'),
    'exceptions' => env('SEDO_EXCEPTIONS', true),

];