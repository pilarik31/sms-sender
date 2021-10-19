<?php

namespace SMSSender;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mailer
{
    private PHPMailer $mailer;

    public function getMailer(): PHPMailer
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->SMTPDebug = SMTP::DEBUG_OFF;
        $this->mailer->isSMTP();
        $this->mailer->Host = $_ENV['EMAIL_HOST'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $_ENV['EMAIL_USERNAME'];
        $this->mailer->Password = $_ENV['EMAIL_PASSWORD'];
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mailer->Port = $_ENV['EMAIL_PORT'];

        $this->mailer->setFrom($_ENV['EMAIL_USERNAME']);

        $this->mailer->isHTML(false);

        return $this->mailer;
    }
}
