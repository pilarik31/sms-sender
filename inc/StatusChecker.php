<?php

namespace SMSSender;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;

class StatusChecker
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['verify' => false]);
    }

    public function isOnline(string $url): bool
    {
        try {
            $res = $this->client->request('GET', $url);
        } catch (RequestException $e) {
            if ($e instanceof ServerException) {
            }
            return false;
        }
        return true;
    }
}
