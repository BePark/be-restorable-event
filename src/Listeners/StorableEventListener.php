<?php

namespace Bepark\Eventer\Listeners;

use Bepark\Eventer\Events\RestorableEvent;
use Bepark\Eventer\Models\Event;
use Bepark\Eventer\Services\Dispatcher;

class StorableEventListener
{
    public function onStorableEvent(RestorableEvent $event)
    {
        Event::createFromStorableEvent($event);
    }

    public function subscribe(Dispatcher $event)
    {
        $event->listenWithChildren(RestorableEvent::class, __CLASS__ . '@onStorableEvent');
    }
}
