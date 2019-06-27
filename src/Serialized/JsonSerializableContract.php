<?php

namespace Bepark\StorableEvent\Serialized;

interface JsonSerializableContract
{
	public function toArray(): array;
}
