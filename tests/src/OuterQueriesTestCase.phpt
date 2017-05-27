<?php

declare(strict_types=1);

namespace UselessSoftTests\Queries;

use Kdyby\StrictObjects\Scream;
use UselessSoft\Queries\Query\CountQuery;
use UselessSoft\Queries\Query\CountQueryHandler;
use UselessSoft\Queries\Query\SingleItemQuery;
use UselessSoft\Queries\Query\SingleItemQueryHandler;
use UselessSoft\Queries\QueryHandlerChain;
use UselessSoftTests\Queries\Mocks\UserQuery;
use UselessSoftTests\Queries\Mocks\UserQueryHandler;
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
		Assert::same(2, $this->queryHandler->handle(new CountQuery(new UserQuery())));
	}


	public function testFirst() : void
	{
		Assert::same(['name' => 'John'], $this->queryHandler->handle(new SingleItemQuery(new UserQuery())));
	}

}


(new OuterQueriesTestCase())->run();
