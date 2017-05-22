<?php

declare(strict_types=1);

namespace Librette\Queries;

use Kdyby\StrictObjects\Scream;

/**
 * @author David Matejka
 */
class CountQuery implements IQuery, IOuterQuery
{
    use Scream;

	/** @var IResultSetQuery */
	private $query;


	/**
	 * @param IResultSetQuery
	 */
	public function __construct(IResultSetQuery $query)
	{
		$this->query = $query;
	}


	/**
	 * @return IQuery
	 */
	public function getInnerQuery() : IQuery
	{
		return $this->query;
	}


	/**
	 * @param IQueryable
	 * @return int
	 */
	public function fetch(IQueryable $queryable) : int
	{
		$result = $queryable->getHandler()->fetch($this->query);

		return $result->getTotalCount();
	}

}
