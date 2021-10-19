<?php

require_once 'vendor/autoload.php';

use Dotenv\Dotenv;
use SMSSender\Update\SystemUpdate;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['EMAIL_HOST', 'EMAIL_USERNAME', 'EMAIL_PASSWORD'])->notEmpty();
$dotenv->required(['EMAIL_PORT'])->notEmpty()->isInteger();

$updater = new SystemUpdate();
$updater->run();
dump($updater->returnCodes);