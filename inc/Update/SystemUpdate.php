<?php

namespace SMSSender\Update;

use SMSSender\Service\SMSService;

final class SystemUpdate
{
    public string $hostname;
    public array $returnCodes = [];
    private SMSService $smsService;

    public function __construct()
    {
        $this->hostname = php_uname('n');
        $this->smsService = new SMSService();
    }

    public function run(): void
    {
        exec(command: 'apt update', result_code: $this->returnCodes[0]);
        exec(command: 'apt upgrade', result_code: $this->returnCodes[1]);
        $this->afterRunEval();
    }

    private function afterRunEval()
    {
        if ($this->returnCodes[0] !== 0 || $this->returnCodes[1] !== 0) {
            $this->smsService->getPila()->send('SZup', 'fail');
            $this->smsService->getKoky()->send('SZup', 'fail');
        }
    }
}
