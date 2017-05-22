<?php

declare(strict_types=1);

namespace LibretteTests\Queries\Mocks;

use Librette\Queries\IResultSet;
use Nette\Utils\Paginator;

/**
 * @author David Matejka
 */
class ResultSet implements \IteratorAggregate, IResultSet
{
	/** @var array */
	private $data;

	/** @var array */
	private $paginated;


	public function __construct(array $data)
	{
		$this->data = $this->paginated = $data;
	}


	public function applyPaginator(Paginator $paginator) : IResultSet
	{
		$this->applyPaging($paginator->getOffset(), $paginator->getLength());
		$paginator->setItemsPerPage($this->getTotalCount());
		return $this;
	}


	public function applyPaging(int $offset, int $limit) : IResultSet
	{
		$this->paginated = array_slice($this->data, $offset, $limit);
		return $this;
	}


	public function getTotalCount() : int
	{
		return count($this->data);
	}


	public function count() : int
	{
		return count($this->paginated);
	}


	public function getIterator() : iterable
	{
		return new \ArrayIterator($this->data);
	}

}
