<?php

namespace Bepark\Eventer\Services;

use Bepark\Eventer\Models\Event;

class Dispatcher extends \Illuminate\Events\Dispatcher
{
    /**
     * Register an event listener with the dispatcher.
     *
     * @param  string|array  $events
     * @param  mixed  $listener
     * @return void
     */
    public function listenWithChildren($events, $listener)
    {
        $this->listen('*', function($eventName, array $data) use ($events, $listener) {

            if(class_exists($eventName) && in_array($events, class_parents($eventName, true)))
            {
                dd($eventName, $events, $listener);
                $this->createClassListener($listener);
                /** @var RestorableEvent $event */
                /*$event = $data[0];

                $listener($event);*/
            }
        });
    }
}
