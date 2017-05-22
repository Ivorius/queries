<?php

declare(strict_types=1);

namespace LibretteTests\Queries\Mocks;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\IQuery;
use Librette\Queries\IQueryModifier;

/**
 * @author David Matejka
 */
class QueryModifier implements IQueryModifier
{
    use Scream;

	public $queries = [];


	public function modify(IQuery $query) : void
	{
		$this->queries[] = $query;
	}

}
