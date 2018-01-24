<?php

namespace CodeFlix\Listeners;

use Prettus\Repository\Events\RepositoryEntityDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use CodeFlix\Models\PayPalWebProfile;
use CodeFlix\PayPal\WebProfileClient;

class DeletePayPalWebProfileListener
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
     * @param  RepositoryEntityDeleted  $event
     * @return void
     */
    public function handle(RepositoryEntityDeleted $event)
    {
        $model = $event->getModel();

        if(!($model instanceof PayPalWebProfile)) {
            return;
        }

        $this->webProfileClient->delete($model->code);
    }
}
