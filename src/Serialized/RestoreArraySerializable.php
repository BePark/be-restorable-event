<?php

namespace Bepark\Eventer\Serialized;

use Illuminate\Queue\SerializesAndRestoresModelIdentifiers;
use ReflectionClass;

class RestoreArraySerializable
{
	use SerializesAndRestoresModelIdentifiers;

    /**
     * Restore an object from a class name and his properties
     *
     * @param string $className
     * @param array $properties
     * @return object
     * @throws \ReflectionException
     */
	public function restoreFromArrayOfProperties(string $className, array $properties)
	{
		// barbaric mode : ON
		$reflectionClass = new ReflectionClass($className);
		if (!$reflectionClass->implementsInterface(RestorableContract::class))
		{
			throw new UnrestorableDataException();
		}

		$object = $reflectionClass->newInstanceWithoutConstructor();

		// restore properties in good shape
		foreach ($properties as $property => $value)
		{
			$object->{$property} = $this->getRestoredPropertyValue($value);
		}

		$object->__restored();

		return $object;
	}
}
