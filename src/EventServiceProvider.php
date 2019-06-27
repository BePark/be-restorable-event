<?php

namespace Bepark\Eventer;

use Bepark\Eventer\Events\RestorableEvent;
use Bepark\Eventer\Listeners\StorableEventListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RestorableEvent::class => [
            StorableEventListener::class
        ]
    ];

    /**
     * Higher = first (100)
     * Lower = last (-1)
     * default = 0
     *
     * @var array
     */
    protected $priorities = [
        StorableEventListener::class => -1, // -1 = last because we want to save it only if everything is ok
    ];
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
