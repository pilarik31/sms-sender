<?php

namespace SMSSender;

use PHPMailer\PHPMailer\PHPMailer;
use SMSSender\Interface\ISMS;

class O2 implements ISMS
{
    private string $number;
    private string $email;
    private PHPMailer $mailer;

    public function __construct() {
        $this->mailer = (new Mailer())->getMailer();
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;
        $this->email = $this->emailFromNumber($number);
        return $this;
    }

    public function send(string $subject, string $body): void
    {
        $this->mailer->addAddress($this->email);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $body;
        $this->mailer->send();
    }

    public function emailFromNumber(string $number): string
    {
        return "00420" . $number . "@sms.cz.o2.com";
    }
}
