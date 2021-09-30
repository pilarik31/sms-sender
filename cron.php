<?php

require_once 'vendor/autoload.php';

use Dotenv\Dotenv;
use SMSSender\O2;
use SMSSender\StatusChecker;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['EMAIL_HOST', 'EMAIL_USERNAME', 'EMAIL_PASSWORD'])->notEmpty();
$dotenv->required(['EMAIL_PORT'])->notEmpty()->isInteger();

$pila = new O2();
$pila->setNumber('720060552');


$websites = json_decode(
    json: file_get_contents('list.json'),
    flags: JSON_PRETTY_PRINT
);


$status = new StatusChecker();

foreach ($websites as $website) {
    $res = $status->isOnline($website);
    $res ?: $pila->send($website, 'ne');
}

