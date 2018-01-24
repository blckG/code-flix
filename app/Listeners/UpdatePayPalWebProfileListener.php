<?php

namespace CodeFlix\Listeners;

use Prettus\Repository\Events\RepositoryEntityUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use CodeFlix\Models\PayPalWebProfile;
use CodeFlix\PayPal\WebProfileClient;

class UpdatePayPalWebProfileListener
{
    private $webProfileClient;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(WebProfileClient $webProfileClient)
    {
        $this->webProfileClient = $webProfileClient;
    }

    /**
     * Handle the event.
     *
     * @param  RepositoryEntityUpdated  $event
     * @return void
     */
    public function handle(RepositoryEntityUpdated $event)
    {
        $model = $event->getModel();

        if(!($model instanceof PayPalWebProfile)) {
            return;
        }

        $this->webProfileClient->update($model);
    }
}
