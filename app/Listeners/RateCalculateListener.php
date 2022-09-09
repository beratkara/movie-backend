<?php

namespace App\Listeners;

use App\Events\RateCalculateEvent;
use App\Models\Movie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RateCalculateListener
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
     * @param  RateCalculateEvent  $event
     * @return void
     */
    public function handle(RateCalculateEvent $event)
    {
        /** @var Movie $movie */
        $movie = Movie::query()->where('service_id', $event->movieId)->firstOrFail();
        $average = $movie->rates()->average('rate');
        $movie->update([
            'average' => $average
        ]);
    }
}
