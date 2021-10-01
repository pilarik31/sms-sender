<?php

namespace SMSSender\Interfaces;

interface ISMS
{
    public function setNumber(string $number): self;

    public function send(string $subject, string $body): void;

    public function emailFromNumber(string $number): string;
}
