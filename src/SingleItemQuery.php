<?php

declare(strict_types=1);

namespace Librette\Queries;

use Kdyby\StrictObjects\Scream;

/**
 * @author David Matejka
 */
class SingleItemQuery implements QueryInterface, OuterQueryInterface
{
    use Scream;

	/** @var ResultSetQueryInterface */
	private $query;


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
	 * @return mixed|null
	 */
	public function fetch(QueryableInterface $queryable)
	{
		/** @var ResultSetInterface $result */
		$result = $queryable->getHandler()->fetch($this->query);
		$result->applyPaging(0, 1);
		$items = iterator_to_array($result);

		return $items ? reset($items) : NULL;
	}

}
