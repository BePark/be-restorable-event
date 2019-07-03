<?php


namespace Bepark\Eventer\Listeners;


use Bepark\Eventer\Events\RestorableEvent;
use Bepark\Eventer\Models\Event;
use Bepark\Eventer\Services\EventHelper;
use Illuminate\Events\Dispatcher;

class EloquentListener
{
    public function storeEloquentEvent(string $eventName, string $modelName, \Eloquent $model)
    {
        Event::createFromEloquentEvent($modelName . ':' . $eventName, $model->getChanges());
    }

    public function subscribe(Dispatcher $event)
    {
        EventHelper::listenAllEloquentEvent($event, __CLASS__ . '@onStorableEvent');
    }
}
