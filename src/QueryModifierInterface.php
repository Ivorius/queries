<?php

declare(strict_types=1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface QueryModifierInterface
{

	/**
	 * @param QueryInterface
	 * @return void
	 */
	public function modify(QueryInterface $query) : void;

}
