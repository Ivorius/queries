<?php

declare(strict_types=1);

namespace UselessSoft\Queries;

interface OuterQueryInterface extends QueryInterface
{

	/**
	 * @return QueryInterface
	 */
	public function getInnerQuery() : QueryInterface;

}
