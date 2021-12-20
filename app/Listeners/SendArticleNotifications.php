<?php

namespace App\Listeners;

use App\Events\PublicArticle;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendArticleNotifications implements ShouldQueue
{
    public $connection = "database";
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PublicArticle  $event
     * @return void
     */
    public function handle(PublicArticle $event)
    {
        //
    }
}
