<?php

namespace Bepark\StorableEvent\Serialized;

interface RestorableContract
{
    /**
     * Called after the restauration to say that it's ready to work ;)
     */
	public function __restored(): void;
}
