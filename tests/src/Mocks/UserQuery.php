<?php

declare(strict_types=1);

namespace LibretteTests\Queries\Mocks;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\QueryInterface;
use Librette\Queries\QueryableInterface;
use Librette\Queries\ResultSetInterface;
use Librette\Queries\ResultSetQueryInterface;

/**
 * @author David Matejka
 */
class UserQuery implements ResultSetQueryInterface
{
    use Scream;

	public function fetch(QueryableInterface $queryable) : ResultSetInterface
	{
		return new ResultSet([['name' => 'John'], ['name' => 'Jack']]);
	}

}
