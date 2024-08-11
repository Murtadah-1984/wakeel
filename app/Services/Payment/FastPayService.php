<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGatewayInterface;
use GuzzleHttp\Client;

class FastPayService implements PaymentGatewayInterface
{
    protected $client;
    protected $token;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = env('FASTPAY_BASE_URL', 'https://staging-apigw-merchant.fast-pay.iq');
    }

    public function authenticate()
    {
        // FastPay authentication logic if required
    }

    public function createPayment(array $data)
    {
        $response = $this->client->post("{$this->baseUrl}/pgw/api/v1/payments", [
            'json' => [
                'store_id' => env('FASTPAY_STORE_ID'),
                'store_password' => env('FASTPAY_STORE_PASSWORD'),
                'amount' => $data['amount'],
                'currency' => $data['currency'],
                'order_id' => $data['order_id'],
                'success_url' => $data['success_url'],
                'cancel_url' => $data['cancel_url'],
                'fail_url' => $data['fail_url'],
                'ipn_url' => $data['ipn_url'],
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function checkPaymentStatus($paymentId)
    {
        $response = $this->client->post("{$this->baseUrl}/pgw/api/v1/payment/status", [
            'json' => [
                'store_id' => env('FASTPAY_STORE_ID'),
                'store_password' => env('FASTPAY_STORE_PASSWORD'),
                'order_id' => $paymentId,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function cancelPayment($paymentId)
    {
        $response = $this->client->post("{$this->baseUrl}/pgw/api/v1/payment/cancel", [
            'json' => [
                'store_id' => env('FASTPAY_STORE_ID'),
                'store_password' => env('FASTPAY_STORE_PASSWORD'),
                'order_id' => $paymentId,
            ],
        ]);

        return $response->getStatusCode() == 204;
    }
}
