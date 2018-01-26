<?php

namespace CodeFlix\Listeners;

use CodeFlix\Contracts\Repositories\SubscriptionRepository;
use CodeFlix\Models\Order;
use Prettus\Repository\Events\RepositoryEntityCreated;
use CodeFlix\PayPal\PaymentClient;
use CodeFlix\Models\Plan;

class CreateSubscriptionListener
{
    /**
     * @var SubscriptionRepository
     */
    private $repository;
    private $paymentClient;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(SubscriptionRepository $repository, PaymentClient $paymentClient)
    {
        $this->repository = $repository;
        $this->paymentClient = $paymentClient;
    }

    /**
     * Handle the event.
     *
     * @param  RepositoryEntityCreated  $event
     * @return void
     */
    public function handle(RepositoryEntityCreated $event)
    {
        $model = $event->getModel();
        if(!($model instanceof Order)) {
            return;
        }

        $payment = $this->paymentClient->get($model->code);
        $planSku = $payment->getTransactions()[0]->getItemList()->getItems()[0]->getSku();
        $planId = Plan::getIdFromSku($planSku);
        $this->repository->create([
            'order_id' => $model->id,
            'plan_id' => $planId
        ]);
    }
}
