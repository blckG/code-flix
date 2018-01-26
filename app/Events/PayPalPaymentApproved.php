<?php

namespace CodeFlix\Events;


use CodeFlix\Models\Plan;
use PayPal\Api\Payment;

class PayPalPaymentApproved
{

    private $plan;
    private $order;
    private $payment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Plan $plan, Payment $payment)
    {
        $this->plan = $plan;
        $this->payment = $payment;
    }

    /**
     * @return mixed
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     * @return PayPalPaymentApproved
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    public function getPayment()
    {
        return $this->payment;
    }


}
