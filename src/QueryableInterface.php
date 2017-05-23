<?php

declare(strict_types=1);

namespace Librette\Queries;

interface QueryableInterface
{

	/**
	 * @return QueryHandlerInterface
	 */
	public function getHandler() : QueryHandlerInterface;

}
