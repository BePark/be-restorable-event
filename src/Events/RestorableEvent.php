<?php

namespace Bepark\StorableEvent\Events;

use Bepark\StorableEvent\Serialized\JsonSerializableContract;
use Bepark\StorableEvent\Serialized\RestorableContract;
use Carbon\Carbon;

abstract class RestorableEvent implements RestorableContract, JsonSerializableContract
{
	use StorableEvent;

	/**
	 * @var Carbon
	 */
	protected $_eventDate;

	public function __restored(): void
	{
	}

	public function setEventDate(Carbon $eventDate): self
	{
		$this->_eventDate = $eventDate;
		return $this;
	}

	public function getEventDate(): Carbon
	{
		return $this->_eventDate ?? now();
	}
}
