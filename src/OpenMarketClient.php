<?php
namespace Tzookb\OpenMarketPhp;

use GuzzleHttp\Client;
use Tzookb\OpenMarketPhp\DOI\SendSms;

class OpenMarketClient
{
    /** @var Client */
    protected $client;

    public function __construct(Client $client) 
    {
        $this->client = $client;
    }

    public function sendMessage(SendSms $sendSms)
    {
        $data = $sendSms->getData();
        $res = $this->client->post('/sms/v4/mt', [
            'data' => $data
        ]);

        return $res;
    }
}