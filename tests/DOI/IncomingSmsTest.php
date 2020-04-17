<?php

use Cordial\OpenMarketPhp\DOI\IncomingSms;
use PHPUnit\Framework\TestCase;

class IncomingSmsTest extends TestCase
{

    protected function setUp(): void
    {
        $this->data = [
            "mobileOriginate" => [
                //...
                "source" => [
                    "address" => "12515550145"
                ],
                "destination" => [
                    "address" => "222111"
                ],
                "message" => [
                    "type" => "text",
                    "content" => "simple text",
                ]
            ]
        ];
    }

    public function atest_plain_text()
    {
        $incomingSms = new IncomingSms($this->data);
        $this->assertEquals('12515550145', $incomingSms->getFromAddress());
        $this->assertEquals('222111', $incomingSms->getToAddress());
        $this->assertEquals('simple text', $incomingSms->getContent());
    }

    public function test_hex_text()
    {
        $this->data['mobileOriginate']['message']['type'] = 'hexEncodedText';
        $this->data['mobileOriginate']['message']['content'] = '050003080202207468696e6b696e672061626f75742069742e';

        $incomingSms = new IncomingSms($this->data);

        $this->assertEquals('thinking about it', $incomingSms->getContent());
    }
}
