<?php

use SedoClient\SedoDomain;

require_once __DIR__ . "/../bootstrap/autoload.php";

$username = getenv('SEDO_USERNAME');
$password = getenv('SEDO_PASSWORD');
$partnerId = getenv('SEDO_PARTNER_ID');
$signKey = getenv('SEDO_SIGN_KEY');

$sedo = new SedoDomain($username, $password, $signKey, $partnerId);

$response = $sedo->insert([[
    'domain' => 'example.com',
    'category' => ['park'],
    'forsale' => 0,
    'price' => 0,
    'minprice' => 0,
    'fixedprice' => 0,
    'currency' => SedoDomain::CURRENCY_USD,
    'domainlanguage' => 'en',
]]);

print_r($response);
