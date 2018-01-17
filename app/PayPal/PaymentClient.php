<?php


namespace CodeFlix\PayPal;


use CodeFlix\Events\PayPalPaymentApproved;
use CodeFlix\Models\Plan;

class PaymentClient
{
    public function doPayment(Plan $plan)
    {
        $event = new PayPalPaymentApproved($plan);
        event($event);
        return $event->getOrder();
    }
}