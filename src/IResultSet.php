<?php

declare(strict_types=1);

namespace Librette\Queries;

/**
 * Lazy collection
 *
 * @author David Matejka
 */
interface IResultSet extends \Traversable, \Countable
{

	/**
	 * @param int
	 * @param int
	 * @throws InvalidStateException
	 * @return self
	 */
	public function applyPaging(int $offset, int $limit) : self;


	/**
	 * @return int
	 */
	public function getTotalCount() : int;

}
