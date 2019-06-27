<?php

namespace Bepark\Eventer;

use Bepark\Eventer\Events\RestorableEvent;
use Bepark\Eventer\Listeners\StorableEventListener;
use Bepark\Eventer\Services\Dispatcher;
use Illuminate\Contracts\Queue\Factory as QueueFactoryContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Higher = first (100)
     * Lower = last (-1)
     * default = 0
     *
     * @var array
     */
    protected $priorities = [];

    protected $subscribe = [];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $this->listen[RestorableEvent::class] = [
            StorableEventListener::class
        ];

        $this->priorities[StorableEventListener::class] = -1;

        // loading our own dispatcher ;)
        $this->app->singleton(
            'events',
            function($app)
            {
                return (new Dispatcher($app))->setQueueResolver(
                    function() use ($app)
                    {
                        return $app->make(QueueFactoryContract::class);
                    }
                );
            }
        );
        //Continue as usual
        parent::boot();
        \Event::setPriorities($this->priorities);
    }
}
