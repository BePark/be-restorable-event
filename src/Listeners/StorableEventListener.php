<?php

namespace Bepark\StorableEvent\Listeners;

use Bepark\StorableEvent\Events\RestorableEvent;
use Bepark\StorableEvent\Models\Event;

class StorableEventListener
{
	public function handle(RestorableEvent $event)
	{
		Event::createFromStorableEvent($event);
	}
}
