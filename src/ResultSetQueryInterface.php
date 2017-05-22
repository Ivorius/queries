<?php

declare(strict_types=1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface ResultSetQueryInterface extends QueryInterface
{

	/**
	 * @param QueryableInterface $queryable
	 * @return ResultSetInterface
	 */
	public function fetch(QueryableInterface $queryable) : ResultSetInterface;

}
