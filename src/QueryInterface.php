<?php

declare(strict_types=1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface QueryInterface
{

	/**
	 * @param QueryableInterface
	 * @return mixed
	 */
	public function fetch(QueryableInterface $queryable);

}
