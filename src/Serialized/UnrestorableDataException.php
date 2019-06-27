<?php

namespace Bepark\Eventer\Serialized;

use Throwable;
use OutOfBoundsException;

class UnrestorableDataException extends OutOfBoundsException
{
	public function __construct(?Throwable $previous = null)
	{
		parent::__construct('Impossible to restore this class instance. ' . RestorableContract::class . ' is not implemented', 0, $previous);
	}
}
