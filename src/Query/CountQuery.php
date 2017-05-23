<?php

declare(strict_types=1);

namespace UselessSoft\Queries\Query;

use Kdyby\StrictObjects\Scream;
use UselessSoft\Queries\OuterQueryInterface;
use UselessSoft\Queries\QueryInterface;

class CountQuery implements QueryInterface, OuterQueryInterface
{
    use Scream;

	/** @var QueryInterface */
	private $query;


	/**
	 * @param QueryInterface
	 */
	public function __construct(QueryInterface $query)
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

}
