<?php
namespace Cordial\OpenMarketPhp;

use GuzzleHttp\Client;

class GetOpenMarketClient
{
    /**
     * @param String $account
     * @param String $password
     * @return OpenMarketClient
     */
    public function get($account, $password)
    {
        $client = new Client([
            'base_uri' => 'https://smsc.openmarket.com',
            'auth' => [$account, $password],
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        return new OpenMarketClient($client);
    }
}