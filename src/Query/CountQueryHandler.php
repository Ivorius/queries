<?php

declare(strict_types=1);

namespace UselessSoft\Queries\Query;

use Kdyby\StrictObjects\Scream;
use UselessSoft\Queries\QueryHandlerInterface;
use UselessSoft\Queries\QueryInterface;
use UselessSoft\Queries\ResultSetInterface;

class CountQueryHandler implements QueryHandlerInterface
{
    use Scream;

    /** @var QueryHandlerInterface */
    private $queryHandler;

    public function __construct(QueryHandlerInterface $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    public function handle(QueryInterface $query)
    {
        assert($query instanceof CountQuery);

        $result = $this->queryHandler->handle($query->getInnerQuery());
        assert($result instanceof ResultSetInterface);

        return $result->getTotalCount();
    }

    public function supports(QueryInterface $query) : bool
    {
        return $query instanceof CountQuery;
    }

}
