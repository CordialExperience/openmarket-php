<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Tzookb\OpenMarketPhp\OpenMarketClient;

class ClientTest extends TestCase
{

    public function test_fb()
    {
        $client = new Client([]);
        $cl = new OpenMarketClient($client);
        $this->assertTrue(true);
    }

}
