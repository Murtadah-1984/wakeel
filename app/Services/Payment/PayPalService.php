<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGatewayInterface;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

class PayPalService implements PaymentGatewayInterface
{
    protected $apiContext;

    public function __construct()
    {
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),
                env('PAYPAL_SECRET')
            )
        );
    }

    public function charge(array $data)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($data['amount']);
        $amount->setCurrency($data['currency']);

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription($data['description']);

        $payment = new Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setTransactions([$transaction]);

        $payment->create($this->apiContext);

        return $payment;
    }
}
