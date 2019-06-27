<?php

namespace Bepark\Eventer\Listeners;

use Bepark\Eventer\Events\RestorableEvent;
use Bepark\Eventer\Models\Event;
use Bepark\Eventer\Services\EventHelper;
use Illuminate\Events\Dispatcher;

class StorableEventListener
{
    public function onStorableEvent(RestorableEvent $event)
    {
        Event::createFromStorableEvent($event);
    }

    public function subscribe(Dispatcher $event)
    {
        EventHelper::listenWithChildren($event, RestorableEvent::class, __CLASS__ . '@onStorableEvent');
    }
}
