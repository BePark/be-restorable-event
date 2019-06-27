<?php

namespace Bepark\Eventer\Listeners;

use Bepark\Eventer\Events\RestorableEvent;
use Bepark\Eventer\Models\Event;

class StorableEventListener
{
	public function handle(RestorableEvent $event)
	{
		Event::createFromStorableEvent($event);
	}
}
