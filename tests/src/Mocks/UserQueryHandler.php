<?php

declare(strict_types=1);

namespace LibretteTests\Queries\Mocks;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\QueryHandlerInterface;
use Librette\Queries\QueryInterface;
use Librette\Queries\ResultSetInterface;

class UserQueryHandler implements QueryHandlerInterface
{
    use Scream;

    public function fetch(QueryInterface $query) : ResultSetInterface
    {
        return new ResultSet([['name' => 'John'], ['name' => 'Jack']]);
    }

    public function supports(QueryInterface $query) : bool
    {
        return $query instanceof UserQuery;
    }
}
