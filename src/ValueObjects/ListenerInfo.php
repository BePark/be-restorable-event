<?php

namespace Bepark\Eventer\ValueObjects;

class ListenerInfo
{
	/**
	 * @var callable
	 */
	protected $_closure;

	/**
	 * @var string
	 */
	protected $_name;

	/**
	 * @param callable $closure
	 * @param string $name
	 */
	public function __construct(callable $closure, $name)
	{
		$this->_closure = $closure;
		$this->_name = $name;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->_name;
	}

	public function __invoke(...$args)
	{
		return ($this->_closure)(...$args);
	}
}
