<?php
namespace App\Services\Attendance;

use GuzzleHttp\Client;

class SkySmsService
{
    protected Client $client;
    protected string $baseUrl;
    protected mixed $user;
    protected mixed $password;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = 'https://skysms.cm/api/public/sendsms';
        $this->user = env('SKYSMS_USER');
        $this->password = env('SKYSMS_PASSWORD');
    }

    public function sendSms($phone, $message, $sender, $dateSend = null, $idSmsClient = null, $output = 'json')
    {
        $url = "{$this->baseUrl}/v1/output={$output}";

        $response = $this->client->get($url, [
            'query' => [
                'user' => $this->user,
                'password' => $this->password,
                'sender' => $sender,
                'phone' => $phone,
                'message' => $message,
                'date_send' => $dateSend,
                'idsmsclient' => $idSmsClient,
            ]
        ]);

        return $response->getBody()->getContents();
    }
}
