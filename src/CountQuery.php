<?php

declare(strict_types=1);

namespace Librette\Queries;

use Kdyby\StrictObjects\Scream;

/**
 * @author David Matejka
 */
class CountQuery implements QueryInterface, OuterQueryInterface
{
    use Scream;

	/** @var ResultSetQueryInterface */
	private $query;


	/**
	 * @param ResultSetQueryInterface
	 */
	public function __construct(ResultSetQueryInterface $query)
	{
		$this->query = $query;
	}


	/**
	 * @return QueryInterface
	 */
	public function getInnerQuery() : QueryInterface
	{
		return $this->query;
	}


	/**
	 * @param QueryableInterface
	 * @return int
	 */
	public function fetch(QueryableInterface $queryable) : int
	{
		$result = $queryable->getHandler()->fetch($this->query);

		return $result->getTotalCount();
	}

}
