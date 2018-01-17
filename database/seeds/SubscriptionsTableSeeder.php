<?php

use CodeFlix\Contracts\Repositories\OrderRepository;
use CodeFlix\Contracts\Repositories\PlanRepository;
use CodeFlix\Contracts\Repositories\SubscriptionRepository;
use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscription = app(SubscriptionRepository::class);
        $plans = app(PlanRepository::class)->all();
        $orders = app(OrderRepository::class)->all();
        foreach (range(1, 20) as $element) {
            $subscription->create([
                'plan_id' => $plans->random()->id,
                'order_id' => $orders->random()->id,
            ]);
        }

    }
}
