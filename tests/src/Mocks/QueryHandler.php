<?php

declare(strict_types=1);

namespace LibretteTests\Queries\Mocks;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\QueryInterface;
use Librette\Queries\QueryableInterface;
use Librette\Queries\QueryHandlerInterface;

/**
 * @author David Matejka
 */
class QueryHandler implements QueryHandlerInterface
{
    use Scream;

	public function supports(QueryInterface $query) : bool
	{
		return $query instanceof UserQuery;
	}


	public function fetch(QueryInterface $query)
	{
		return $query->fetch(\Mockery::mock(QueryableInterface::class));
	}

}
