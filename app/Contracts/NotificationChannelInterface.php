<?php

namespace App\Contracts;

interface NotificationChannelInterface
{
    public function send($to, $message);
}
