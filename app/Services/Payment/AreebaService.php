<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGatewayInterface;
use GuzzleHttp\Client;

class AreebaService implements PaymentGatewayInterface
{
    protected $client;
    protected $baseUrl;
    protected $merchantId;
    protected $apiPassword;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = env('AREEBA_BASE_URL', 'https://epayment.areeba.com/api/rest/version/78');
        $this->merchantId = env('AREEBA_MERCHANT_ID');
        $this->apiPassword = env('AREEBA_API_PASSWORD');
    }

    public function authenticate()
    {
        // Areeba does not require a separate authentication step
    }

    public function createPayment(array $data)
    {
        $credentials = base64_encode("merchant.{$this->merchantId}:{$this->apiPassword}");
        $response = $this->client->post("{$this->baseUrl}/merchant/{$this->merchantId}/session", [
            'headers' => [
                'Authorization' => 'Basic ' . $credentials,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'apiOperation' => 'INITIATE_CHECKOUT',
                'interaction' => [
                    'operation' => 'PURCHASE',
                    'merchant' => [
                        'name' => $data['merchant_name'],
                        'address' => [
                            'line1' => $data['merchant_address_line1'],
                            'line2' => $data['merchant_address_line2'],
                        ],
                    ],
                ],
                'order' => [
                    'currency' => $data['currency'],
                    'id' => $data['order_id'],
                    'amount' => $data['amount'],
                    'description' => $data['description'],
                ],
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function checkPaymentStatus($paymentId)
    {
        $credentials = base64_encode("merchant.{$this->merchantId}:{$this->apiPassword}");
        $response = $this->client->get("{$this->baseUrl}/merchant/{$this->merchantId}/order/{$paymentId}", [
            'headers' => [
                'Authorization' => 'Basic ' . $credentials,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function cancelPayment($paymentId)
    {
        // Areeba does not provide a specific endpoint for cancelling a payment
        throw new \Exception("Areeba does not support cancelling payments");
    }
}
