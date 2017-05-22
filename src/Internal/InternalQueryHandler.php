<?php

declare(strict_types=1);

namespace Librette\Queries\Internal;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\OuterQueryInterface;
use Librette\Queries\QueryInterface;
use Librette\Queries\QueryHandlerInterface;
use Librette\Queries\QueryHandlerAccessorInterface;

/**
 * @author David Matejka
 */
class InternalQueryHandler implements QueryHandlerInterface
{
    use Scream;

	/** @var QueryHandlerAccessorInterface */
	private $queryHandlerAccessor;


	/**
	 * @param QueryHandlerAccessorInterface
	 */
	public function __construct(QueryHandlerAccessorInterface $queryHandlerAccessor)
	{
		$this->queryHandlerAccessor = $queryHandlerAccessor;
	}


	public function supports(QueryInterface $query) : bool
	{
		return $query instanceof OuterQueryInterface;
	}


	public function fetch(QueryInterface $query)
	{
		return $query->fetch(new InternalQueryable($this->queryHandlerAccessor->get()));
	}

}
