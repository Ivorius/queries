<?php

declare(strict_types=1);

namespace LibretteTests\Queries;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\CountQuery;
use Librette\Queries\Internal\InternalQueryHandler;
use Librette\Queries\QueryHandlerChain;
use Librette\Queries\SingleItemQuery;
use LibretteTests\Queries\Mocks\QueryHandler;
use LibretteTests\Queries\Mocks\UserQuery;
use Nette;
use Tester;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';


/**
 * @author David Matějka
 * @testCase
 */
class OuterQueriesTestCase extends Tester\TestCase
{
    use Scream;

	/** @var QueryHandler */
	private $queryHandler;


	public function setUp() : void
	{
		$this->queryHandler = $queryHandler = new QueryHandlerChain();
		$internalQh = new InternalQueryHandler($queryHandler);
		$queryHandler->addHandler($internalQh);
		$queryHandler->addHandler(new QueryHandler());
	}


	public function tearDown() : void
	{
		\Mockery::close();
	}


	public function testCount() : void
	{
		Assert::same(2, $this->queryHandler->fetch(new CountQuery(new UserQuery())));
	}


	public function testFirst() : void
	{
		Assert::same(['name' => 'John'], $this->queryHandler->fetch(new SingleItemQuery(new UserQuery())));
	}

}


(new OuterQueriesTestCase())->run();
