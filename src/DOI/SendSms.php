<?php
namespace Tzookb\OpenMarketPhp\DOI;

class SendSms
{
    public $interaction = 'two-way';
    public $promotional = true;
    public $programId = '1234'; //todo
    public $destinationPhone = 'two-way';
    public $ton = 'two-way';
    public $sourceFrom = 'two-way';
    public $content = 'two-way';
    public $type = 'two-way';
    public $mlc = 'segment';
    public $receiptRequested = 'final';

    public function getData()
    {
        return [
            "mobileTerminate" => [
                "interaction" => $this->interaction,
                "promotional" => $this->promotional,
                "options" => [
                    "programId" => $this->programId
                ],
                "destination" => [
                    "address" => $this->destinationPhone,
                ],
                "source" => [
                    "ton" => $this->ton,
                    "address" => $this->sourceFrom
                ],
                "message" => [
                    "content" => $this->content,
                    "type" => $this->type,
                    "mlc" => $this->mlc,
                ],
                "delivery" => [
                    "receiptRequested" => $this->receiptRequested,
                    //in case you want to alter delivery reciept from initial account setup
                    // "url" => "https:my.example.com/receiver.php"
                ]
            ]
        ];
    }
}