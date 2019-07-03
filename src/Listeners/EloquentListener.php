<?php


namespace Bepark\Eventer\Listeners;


use Bepark\Eventer\Events\RestorableEvent;
use Bepark\Eventer\Services\EventHelper;
use Illuminate\Events\Dispatcher;

class EloquentListener
{
    public function storeEloquentEvent($eventName, $data)
    {
        dd($data);
    }

    public function subscribe(Dispatcher $event)
    {
        EventHelper::listenAllEloquentEvent($event, __CLASS__ . '@onStorableEvent');
    }
}
