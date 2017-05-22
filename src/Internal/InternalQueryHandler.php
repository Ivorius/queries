<?php

declare(strict_types=1);

namespace Librette\Queries\Internal;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\OuterQueryInterface;
use Librette\Queries\QueryInterface;
use Librette\Queries\QueryHandlerInterface;

/**
 * @author David Matejka
 */
class InternalQueryHandler implements QueryHandlerInterface
{
    use Scream;

	/** @var QueryHandlerInterface */
	private $queryHandler;


	/**
	 * @param QueryHandlerInterface
	 */
	public function __construct(QueryHandlerInterface $queryHandler)
	{
		$this->queryHandler = $queryHandler;
	}


	public function supports(QueryInterface $query) : bool
	{
		return $query instanceof OuterQueryInterface;
	}


	public function fetch(QueryInterface $query)
	{
		return $query->fetch(new InternalQueryable($this->queryHandler));
	}

}
