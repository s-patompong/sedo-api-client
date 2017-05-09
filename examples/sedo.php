<?php

require_once __DIR__."/../bootstrap/autoload.php";

$username = getenv('SEDO_USERNAME');
$password = getenv('SEDO_PASSWORD');
$partnerId = getenv('SEDO_PARTNER_ID');
$signKey = getenv('SEDO_SIGN_KEY');

$sedo = new \SedoClient\Sedo($username, $password, $partnerId, $signKey);

$response = $sedo->call()->getResponse();

print_r($response);