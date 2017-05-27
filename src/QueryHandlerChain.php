<?php

declare(strict_types=1);

namespace UselessSoft\Queries;

use Kdyby\StrictObjects\Scream;
use UselessSoft\Queries\Exception\InvalidArgumentException;

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
	public function handle(QueryInterface $query)
	{
		$handler = $this->resolveHandler($query);
		if ($handler === NULL) {
			throw new InvalidArgumentException("Unsupported query.");
		}

		return $handler->handle($query);
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
