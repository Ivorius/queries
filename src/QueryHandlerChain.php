<?php

declare(strict_types=1);

namespace Librette\Queries;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\Exception\InvalidArgumentException;

class QueryHandlerChain implements QueryHandlerInterface
{
    use Scream;

	/** @var QueryHandlerInterface[] */
	private $handlers = [];

	/**
	 * @param QueryHandlerInterface
	 */
	public function addHandler(QueryHandlerInterface $handler) : void
	{
		$this->handlers[] = $handler;
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
