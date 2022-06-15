<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key= 'debbcb85ebf8547239e21af969422be0';
    private $api_key_secret = '139963066a8207b4019b50c2a8d76b63';

    public function send($to_email, $to_name, $subject, $content)
    {
       $mj = new Client($this->api_key,$this->api_key_secret,true,['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "priviacom@gmail.com",
                        'Name' => "arnaud jean"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'Variables' => [
                        'content' => $content
                    ],
                    'TemplateID' => 3431005,
                    'TemplateLanguage' => true,
                    'Subject' => $subject
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && dd($response->getData());
    }
}
