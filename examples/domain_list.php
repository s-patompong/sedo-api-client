<?php

use SedoClient\SedoDomain;

require_once __DIR__ . "/../bootstrap/autoload.php";

$username = getenv('SEDO_USERNAME');
$password = getenv('SEDO_PASSWORD');
$partnerId = getenv('SEDO_PARTNER_ID');
$signKey = getenv('SEDO_SIGN_KEY');
$isLog = getenv('SEDO_LOG');
$logPath = getenv('SEDO_LOG_PATH');

$sedo = new SedoDomain($username, $password, $signKey, $partnerId);

$sedo->setIsLog($isLog)->setLogPath($logPath);

$response = $sedo->list()->toArray();

print_r($response);