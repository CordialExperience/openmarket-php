<?php
namespace Cordial\OpenMarketPhp\DOI;
/**
 * class that handle incoming sms from OpenMarket.
 * More info on their docs:
 * https://www.openmarket.com/docs/Content/apis/v4http/receive-mo-json.htm
 * 
 * example:
        {
            "mobileOriginate": {
                "submittedDate": "2015-08-29T15:10:03.029-05:00",
                "ticketId": "8514F-01278-17445-23FSJ",
                "source": {
                    "ton": 1,
                    "address": "12515550145",
                    "mobileOperatorId" : 383
                },
                "destination": {
                    "ton": 3,
                    "address": "222111"
                },
                "message": {
                    "type": "hexEncodedText",
                    "content": "050003080202207468696e6b696e672061626f75742069742e",
                    "udh": true
                }
            }
        }
 */
class IncomingSms
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data['mobileOriginate'] ?? [];
    }

    public function getFromAddress()
    {
        return $this->data['source']['address'] ?? '';
    }

    public function getToAddress()
    {
        return $this->data['destination']['address'] ?? '';
    }

    public function getContent()
    {
        $type = $this->data['message']['type'] ?? 'text';
        $content = $this->data['message']['content'] ?? '';

        if ($type === 'text') {
            return $content;
        }

        if ($type === 'hexEncodedText') {
            return hex2bin($content);
        }

        if ($type === 'binary') {
            return $this->binaryToString($content);
        }
    }

    protected function binaryToString($binary)
    {
        $binaries = explode(' ', $binary);

        $string = null;
        foreach ($binaries as $binary) {
            $string .= pack('H*', dechex(bindec($binary)));
        }

        return $string;
    }
}