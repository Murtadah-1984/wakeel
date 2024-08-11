<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGatewayInterface;
use GuzzleHttp\Client;

class FIBService implements PaymentGatewayInterface
{
    protected $client;
    protected $token;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function authenticate()
    {
        $response = $this->client->post('https://fib.stage.fib.iq/auth/realms/fib-online-shop/protocol/openid-connect/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => env('FIB_CLIENT_ID'),
                'client_secret' => env('FIB_CLIENT_SECRET'),
            ]
        ]);

        $body = json_decode((string) $response->getBody(), true);
        $this->token = $body['access_token'];
    }

    public function createPayment(array $data)
    {
        $this->authenticate();

        $response = $this->client->post('https://fib.stage.fib.iq/protected/v1/payments', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function checkPaymentStatus($paymentId)
    {
        $this->authenticate();

        $response = $this->client->get("https://fib.stage.fib.iq/protected/v1/payments/{$paymentId}/status", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function cancelPayment($paymentId)
    {
        $this->authenticate();

        $response = $this->client->post("https://fib.stage.fib.iq/protected/v1/payments/{$paymentId}/cancel", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        return $response->getStatusCode() == 204;
    }
}
