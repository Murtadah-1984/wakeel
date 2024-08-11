<?php

namespace App\Contracts;

interface PaymentGatewayInterface
{
    public function authenticate();
    public function createPayment(array $data);
    public function checkPaymentStatus($paymentId);
    public function cancelPayment($paymentId);
}
