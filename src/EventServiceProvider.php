<?php

namespace Bepark\Eventer;

use Bepark\Eventer\Listeners\StorableEventListener;
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

        parent::boot();
    }
}
