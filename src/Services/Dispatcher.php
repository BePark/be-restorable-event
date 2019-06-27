<?php

namespace Bepark\Eventer\Services;

use Bepark\Eventer\ValueObjects\ListenerInfo;

/**
 * Extends \Illuminate\Events\Dispatcher to add the support of interface for listeners
 *
 * @package App\Services
 */
class Dispatcher extends \Illuminate\Events\Dispatcher
{
	protected $priorities = [];

	public function setPriorities($priorities)
	{
		$this->priorities = $priorities;
	}

	public function getListeners($eventName)
	{
		$parent = parent::getListeners($eventName);

		$priorities = array_map(
			function ($listener)
			{
				if ($listener instanceof ListenerInfo && isset($this->priorities[ $listener->getName() ]))
				{
					return $this->priorities[ $listener->getName() ];
				}

				return 0;
			},
			$parent
		);

		array_multisort($priorities, SORT_DESC, $parent);
		return $parent;
	}

	public function createClassListener($listener, $wildcard = false)
	{
		return new ListenerInfo(
			parent::createClassListener($listener, $wildcard),
			$listener
		);
	}

    /**
     * The only change is the management of ListenerInfo to not be cast to array.
     * @param string $eventName
     * @param array $listeners
     * @return array
     * @see \Illuminate\Events\Dispatcher::addInterfaceListeners
     */
	protected function addInterfaceListeners($eventName, array $listeners = [])
	{
		foreach (class_implements($eventName) as $interface)
		{
			if (isset($this->listeners[ $interface ]))
			{
				foreach ($this->listeners[ $interface ] as $names)
				{
					if ($names instanceof ListenerInfo)
					{
						$listeners[] = $names;
					}
					else
					{
						$listeners = array_merge($listeners, (array)$names);
					}
				}
			}
		}

		return $listeners;
	}
}
