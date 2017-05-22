<?php

declare(strict_types=1);

namespace Librette\Queries;

use Kdyby\StrictObjects\Scream;

/**
 * @author David Matejka
 */
class QueryHandlerChain implements QueryHandlerInterface
{
    use Scream;

	/** @var QueryHandlerInterface[] */
	private $handlers = [];

	/** @var QueryModifierInterface[] */
	private $modifiers = [];


	/**
	 * @param QueryHandlerInterface
	 */
	public function addHandler(QueryHandlerInterface $handler) : void
	{
		$this->handlers[] = $handler;
	}


	/**
	 * @param QueryModifierInterface
	 */
	public function addModifier(QueryModifierInterface $queryModifier) : void
	{
		$this->modifiers[] = $queryModifier;
	}


	public function supports(QueryInterface $query) : bool
	{
		foreach ($this->handlers as $handler) {
			if ($handler->supports($query)) {
				return TRUE;
			}
		}

		return FALSE;
	}


	/**
	 * @param IQuery
	 * @return mixed|ResultSetInterface
	 */
	public function fetch(QueryInterface $query)
	{
		$handler = $this->resolveHandler($query);
		if ($handler === NULL) {
			throw new InvalidArgumentException("Unsupported query.");
		}

		foreach ($this->modifiers as $modifier) {
			$modifier->modify($query);
		}

		return $handler->fetch($query);
	}


	private function resolveHandler(QueryInterface $query) : ?QueryHandlerInterface
	{
		foreach ($this->handlers as $handler) {
			if ($handler->supports($query)) {
				return $handler;
			}
		}

		return NULL;
	}
}
