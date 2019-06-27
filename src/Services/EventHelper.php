<?php

namespace Bepark\Eventer\Services;

use Bepark\Eventer\Models\Event;
use Illuminate\Events\Dispatcher;

class EventHelper
{
    /**
     * Register an event listener with the dispatcher.
     *
     * @param $event Dispatcher
     * @param  string  $parentClassName
     * @param  mixed  $listener
     * @return void
     */
    public static function listenWithChildren(Dispatcher $event, string $parentClassName, string $listener)
    {
        $event->listen('*', function($eventName, array $data) use ($event, $parentClassName, $listener) {

            if(class_exists($eventName) && in_array($parentClassName, class_parents($eventName, true)))
            {
                /** @var RestorableEvent $event */
                $event = $data[0];

                list($listener, $method) = explode('@', $listener);

                $listener = app()->make($listener);
                $listener->$method($event);
            }
        });
    }
}
