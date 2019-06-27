<?php

namespace Bepark\StorableEvent;

use Bepark\StorableEvent\Events\RestorableEvent;
use Bepark\StorableEvent\Listeners\StorableEventListener;
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
            StorableEventListener::class,
        ]
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
