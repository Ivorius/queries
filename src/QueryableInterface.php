<?php

declare(strict_types=1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface QueryableInterface
{

	/**
	 * @return QueryHandlerInterface
	 */
	public function getHandler() : QueryHandlerInterface;

}
