<?php
namespace Cordial\OpenMarketPhp;

use GuzzleHttp\Client;
use Cordial\OpenMarketPhp\DOI\SendSms;

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
            'json' => $data
        ]);
        return $res;
    }
}