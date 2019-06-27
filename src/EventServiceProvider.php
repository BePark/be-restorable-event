<?php

namespace Bepark\Eventer;

use Bepark\Eventer\Listeners\StorableEventListener;
use Bepark\Eventer\Services\Dispatcher;
use Illuminate\Contracts\Queue\Factory as QueueFactoryContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [];

    protected $subscribe = [];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $this->subscribe[] = StorableEventListener::class;

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

        parent::boot();
    }
}
