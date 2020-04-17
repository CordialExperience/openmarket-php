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

    public function test_plain_text()
    {
        $incomingSms = new IncomingSms($this->data);
        $this->assertEquals('12515550145', $incomingSms->getFromAddress());
        $this->assertEquals('222111', $incomingSms->getToAddress());
        $this->assertEquals('simple text', $incomingSms->getContent());
    }

    public function test_hex_text()
    {
        $this->data['mobileOriginate']['message']['type'] = 'hexEncodedText';
        $this->data['mobileOriginate']['message']['content'] = '7468696e6b696e672061626f7574206974';

        $incomingSms = new IncomingSms($this->data);

        $this->assertEquals('thinking about it', $incomingSms->getContent());
    }

    public function test_binary_text()
    {
        $binaryText = $this->strigToBinary('thinking about it');
        $this->data['mobileOriginate']['message']['type'] = 'binary';
        $this->data['mobileOriginate']['message']['content'] = $binaryText;

        $incomingSms = new IncomingSms($this->data);

        $this->assertEquals('thinking about it', $incomingSms->getContent());
    }

    protected function strigToBinary($string)
    {
        $characters = str_split($string);

        $binary = [];
        foreach ($characters as $character) {
            $data = unpack('H*', $character);
            $binary[] = base_convert($data[1], 16, 2);
        }

        return implode(' ', $binary);
    }

}
