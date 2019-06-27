<?php

namespace  Bepark\StorableEvent\Models;

use Bepark\StorableEvent\Serialized\JsonSerializableContract;
use Bepark\StorableEvent\Serialized\RestorableContract;
use Bepark\StorableEvent\Serialized\RestoreArraySerializable;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	public $timestamps = true;
	const CREATED_AT = 'occurred';

	protected $casts = [
		'data' => 'json',
	];

	protected $dates = [
		'occurred',
	];

	protected $fillable = [
		'occurred',
		'name',
		'data'
	];

	public static function createFromStorableEvent(JsonSerializableContract $event): self
	{
		return self::create([
			'name' => get_class($event),
			'data' => $event->toArray(),
		]);
	}

    /**
     * Restore the event as an event object
     *
     * @return RestorableContract
     * @throws \ReflectionException
     */
	public function restore(): RestorableContract
	{
		$restorator = new RestoreArraySerializable();
		$event = $restorator->restoreFromArrayOfProperties($this->name, $this->data);
		$event->setEventDate($this->occurred);
		return $event;
	}

	public function setUpdatedAt($value)
	{
		// trick for using internal mechanism for automated update
		// but we have no updated field, so nothing to do ;)
		return $this;
	}
}
