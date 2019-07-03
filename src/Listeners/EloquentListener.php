<?php


namespace Bepark\Eventer\Listeners;

use Bepark\Eventer\Models\Event;
use Bepark\Eventer\Services\EventHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Events\Dispatcher;

class EloquentListener
{
    public function storeEloquentEvent(string $eventName, string $modelName, Model $model)
    {
        Event::createFromEloquentEvent($modelName . ':' . $eventName, $modelName, $model);
    }

    public function subscribe(Dispatcher $event)
    {
        EventHelper::listenAllEloquentEvent($event, __CLASS__ . '@storeEloquentEvent');
    }
}
