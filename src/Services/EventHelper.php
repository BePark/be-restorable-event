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

    public static function listenAllEloquentEvent(Dispatcher $event, string $listener)
    {
        $event->listen('eloquent.*', function($eventName, array $data) use ($listener) {

            preg_match('#eloquent.(.*): (.*)#', $eventName, $matches);

            $eventName = $matches[1];
            $modelName = $matches[2];

            /** @var \Eloquent $model */
            $model = $data[0];

            list($listener, $method) = explode('@', $listener);

            $listener = app()->make($listener);
            $listener->$method($eventName, $modelName, $model);
        });
    }
}
