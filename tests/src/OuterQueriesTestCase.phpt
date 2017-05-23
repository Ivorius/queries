<?php

declare(strict_types=1);

namespace LibretteTests\Queries;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\Query\CountQuery;
use Librette\Queries\Query\CountQueryHandler;
use Librette\Queries\Query\SingleItemQuery;
use Librette\Queries\Query\SingleItemQueryHandler;
use Librette\Queries\QueryHandlerChain;
use LibretteTests\Queries\Mocks\UserQuery;
use LibretteTests\Queries\Mocks\UserQueryHandler;
use Tester;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';


/**
 * @testCase
 */
class OuterQueriesTestCase extends Tester\TestCase
{
    use Scream;

	/** @var UserQueryHandler */
	private $queryHandler;


	public function setUp() : void
	{
		$this->queryHandler = $queryHandler = new QueryHandlerChain();

		$queryHandler->addHandler(new CountQueryHandler($queryHandler));
		$queryHandler->addHandler(new SingleItemQueryHandler($queryHandler));
		$queryHandler->addHandler(new UserQueryHandler());
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
