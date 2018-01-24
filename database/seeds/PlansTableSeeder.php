<?php

use Illuminate\Database\Seeder;
use CodeFlix\Contracts\Repositories\PayPalWebProfileRepository;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $webProfiles = app(PayPalWebProfileRepository::class)->all();
        factory(\CodeFlix\Models\Plan::class)
            ->states(\CodeFlix\Models\Plan::DURATION_MONTHLY)
            ->create([
                'paypal_web_profile_id' => $webProfiles->random()->id
            ]);

        factory(\CodeFlix\Models\Plan::class)
            ->states(\CodeFlix\Models\Plan::DURATION_YEARLY)
            ->create([
                'paypal_web_profile_id' => $webProfiles->random()->id
            ]);
    }
}
