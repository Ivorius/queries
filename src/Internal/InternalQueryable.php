<?php

declare(strict_types=1);

namespace Librette\Queries\Internal;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\QueryableInterface;
use Librette\Queries\QueryHandlerInterface;

/**
 * @author David Matejka
 */
class InternalQueryable implements QueryableInterface
{
    use Scream;

	/** @var QueryHandlerInterface */
	private $queryHandler;


	public function __construct(QueryHandlerInterface $queryHandler)
	{
		$this->queryHandler = $queryHandler;
	}


	/**
	 * @return QueryHandlerInterface
	 */
	public function getHandler() : QueryHandlerInterface
	{
		return $this->queryHandler;
	}

}
