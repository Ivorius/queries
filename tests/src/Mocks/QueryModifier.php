<?php

declare(strict_types=1);

namespace LibretteTests\Queries\Mocks;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\QueryInterface;
use Librette\Queries\QueryModifierInterface;

/**
 * @author David Matejka
 */
class QueryModifier implements QueryModifierInterface
{
    use Scream;

	public $queries = [];


	public function modify(QueryInterface $query) : void
	{
		$this->queries[] = $query;
	}

}
