<?php

declare(strict_types=1);

namespace UselessSoft\Queries\Query;

use Kdyby\StrictObjects\Scream;
use UselessSoft\Queries\QueryHandlerInterface;
use UselessSoft\Queries\QueryInterface;
use UselessSoft\Queries\ResultSetInterface;

class SingleItemQueryHandler implements QueryHandlerInterface
{
    use Scream;

    /** @var QueryHandlerInterface */
    private $queryHandler;

    public function __construct(QueryHandlerInterface $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    public function fetch(QueryInterface $query)
    {
        assert($query instanceof SingleItemQuery);

        $result = $this->queryHandler->fetch($query->getInnerQuery());
        assert($result instanceof ResultSetInterface);

        $result->applyPaging(0, 1);
        $items = iterator_to_array($result);

        return $items ? reset($items) : NULL;
    }

    public function supports(QueryInterface $query) : bool
    {
        return $query instanceof SingleItemQuery;
    }

}
