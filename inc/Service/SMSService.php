<?php

namespace SMSSender\Service;

use SMSSender\Operator\O2;
use SMSSender\Operator\Vodafone;

class SMSService
{
    public function getPila(): O2
    {
        return (new O2())->setNumber('720060552');
    }

    public function getKoky(): Vodafone
    {
        return (new Vodafone)->setNumber('test');
    }
}
