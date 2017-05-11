<?php

require_once __DIR__."/../bootstrap/autoload.php";

$username = getenv('SEDO_USERNAME');
$password = getenv('SEDO_PASSWORD');
$partnerId = getenv('SEDO_PARTNER_ID');
$signKey = getenv('SEDO_SIGN_KEY');

$sedo = new \SedoClient\SedoDomain($username, $password, $signKey, $partnerId);

$response = $sedo->delete(['abc.example.com', 'def.example.com', 'ghi.example.com']);

print_r($response);