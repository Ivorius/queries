<?php

declare(strict_types=1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface OuterQueryInterface extends QueryInterface
{

	/**
	 * @return QueryInterface
	 */
	public function getInnerQuery() : QueryInterface;

}
