<?php

namespace Bepark\Eventer\Serialized;

interface JsonSerializableContract
{
	public function toArray(): array;
}
