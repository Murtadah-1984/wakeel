<?php

namespace App\Services\Payment;

use App\Contracts\PaymentGatewayInterface;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripeService implements PaymentGatewayInterface
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function authenticate()
    {
        // Stripe does not require a separate authentication step
    }

    public function createPayment(array $data)
    {
        $paymentIntent = PaymentIntent::create([
            'amount' => $data['amount'] * 100, // Stripe accepts amount in cents
            'currency' => $data['currency'],
            'description' => $data['description'],
            'metadata' => ['order_id' => $data['order_id']],
        ]);

        return $paymentIntent;
    }

    public function checkPaymentStatus($paymentId)
    {
        $paymentIntent = PaymentIntent::retrieve($paymentId);

        return $paymentIntent;
    }

    public function cancelPayment($paymentId)
    {
        $paymentIntent = PaymentIntent::retrieve($paymentId);
        $paymentIntent->cancel();

        return $paymentIntent;
    }
}
