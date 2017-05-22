<?php

declare(strict_types=1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface QueryHandlerAccessorInterface
{

	/**
	 * @return QueryHandlerInterface
	 */
	public function get() : QueryHandlerInterface;

}
