<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGatewayInterface;
use GuzzleHttp\Client;
use Firebase\JWT\JWT;

class ZainCashService implements PaymentGatewayInterface
{
    protected $client;
    protected $baseUrl;
    protected $merchantId;
    protected $merchantSecret;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = env('ZAINCASH_BASE_URL', 'https://test.zaincash.iq');
        $this->merchantId = env('ZAINCASH_MERCHANT_ID');
        $this->merchantSecret = env('ZAINCASH_MERCHANT_SECRET');
    }

    public function authenticate()
    {
        // ZainCash does not require a separate authentication step
    }

    public function createPayment(array $data)
    {
        $tokenData = [
            'amount' => $data['amount'],
            'serviceType' => $data['service_type'],
            'msisdn' => $data['msisdn'],
            'orderId' => $data['order_id'],
            'redirectUrl' => $data['redirect_url'],
            'iat' => time(),
            'exp' => time() + 60 * 60 * 4
        ];

        $token = JWT::encode($tokenData, $this->merchantSecret, 'HS256');

        $response = $this->client->post("{$this->baseUrl}/transaction/init", [
            'form_params' => [
                'token' => urlencode($token),
                'merchantId' => $this->merchantId,
                'lang' => 'en'
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function checkPaymentStatus($paymentId)
    {
        $tokenData = [
            'id' => $paymentId,
            'msisdn' => env('ZAINCASH_MSISDN'),
            'iat' => time(),
            'exp' => time() + 60 * 60 * 4
        ];

        $token = JWT::encode($tokenData, $this->merchantSecret, 'HS256');

        $response = $this->client->post("{$this->baseUrl}/transaction/get", [
            'form_params' => [
                'token' => urlencode($token),
                'merchantId' => $this->merchantId,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function cancelPayment($paymentId)
    {
        // ZainCash does not provide a cancel endpoint, assuming there's no way to cancel a transaction
        throw new \Exception("ZainCash does not support canceling payments");
    }
}
