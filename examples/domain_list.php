<?php

use SedoClient\SedoDomain;

require_once __DIR__ . "/../bootstrap/autoload.php";

$username = getenv('SEDO_USERNAME');
$password = getenv('SEDO_PASSWORD');
$partnerId = getenv('SEDO_PARTNER_ID');
$signKey = getenv('SEDO_SIGN_KEY');

$sedo = new SedoDomain($username, $password, $signKey, $partnerId);

$response = $sedo->list()->toArray();

print_r($response);