<?php

declare(strict_types=1);

namespace Librette\Queries;

/**
 * @author David Matejka
 */
interface IQueryHandler
{

	/**
	 * @param IQuery
	 * @return bool
	 */
	public function supports(IQuery $query) : bool;


	/**
	 * @param IQuery
	 * @return mixed|IResultSet
	 */
	public function fetch(IQuery $query);

}
