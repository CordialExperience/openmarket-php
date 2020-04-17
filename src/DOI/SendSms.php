<?php
namespace Cordial\OpenMarketPhp\DOI;

class SendSms
{
    public $interaction = 'two-way';
    public $promotional = true;
    public $programId = '';
    public $destinationPhone;
    public $ton = '3';
    public $sourceFrom;
    public $content = '';
    public $type = 'text';
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