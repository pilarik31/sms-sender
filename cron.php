<?php

require_once 'vendor/autoload.php';

use Dotenv\Dotenv;
use SMSSender\StatusChecker;
use SMSSender\Service\SMSService;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['EMAIL_HOST', 'EMAIL_USERNAME', 'EMAIL_PASSWORD'])->notEmpty();
$dotenv->required(['EMAIL_PORT'])->notEmpty()->isInteger();

$smsService = new SMSService();

$pila = $smsService->getPila();
$koky = $smsService->getKoky();


$websites = json_decode(
    json: file_get_contents('list.json'),
    flags: JSON_PRETTY_PRINT
);


$status = new StatusChecker();

foreach ($websites as $website) {
    $res = $status->isOnline($website);
    $res ?: $pila->send($website, 'ne');
    $res ?: $koky->send($website, $website . ' není dostupná!');
}
