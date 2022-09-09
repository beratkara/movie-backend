<?php

namespace App\Listeners;

use App\Events\MovieFetchedFromCache;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class MovieFetchedFromCacheListener implements ShouldQueue
{
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
     * @param  MovieFetchedFromCache  $event
     * @return void
     */
    public function handle(MovieFetchedFromCache $event)
    {
        Log::channel('custom')->info('Aranan veri cachede bulundu : ' . $event->name, $event->data);
    }
}
