<?php

declare(strict_types=1);

namespace UselessSoftTests\Queries\Mocks;

use Kdyby\StrictObjects\Scream;
use UselessSoft\Queries\QueryHandlerInterface;
use UselessSoft\Queries\QueryInterface;
use UselessSoft\Queries\ResultSetInterface;

class UserQueryHandler implements QueryHandlerInterface
{
    use Scream;

    public function handle(QueryInterface $query) : ResultSetInterface
    {
        return new ResultSet([['name' => 'John'], ['name' => 'Jack']]);
    }

    public function supports(QueryInterface $query) : bool
    {
        return $query instanceof UserQuery;
    }
}
