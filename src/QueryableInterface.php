<?php

declare(strict_types=1);

namespace UselessSoft\Queries;

interface QueryableInterface
{

	/**
	 * @return QueryHandlerInterface
	 */
	public function getHandler() : QueryHandlerInterface;

}
