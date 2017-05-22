<?php

declare(strict_types=1);

namespace Librette\Queries;

use Nette\Utils\Paginator;


/**
 * Lazy collection
 *
 * @author David Matejka
 */
interface IResultSet extends \Traversable, \Countable
{

	/**
	 * @param Paginator
	 * @throws InvalidStateException
	 * @return self
	 */
	public function applyPaginator(Paginator $paginator) : self;


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
