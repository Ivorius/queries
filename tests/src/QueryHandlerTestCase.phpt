<?php

declare(strict_types=1);

namespace UselessSoftTests\Queries;

use Kdyby\StrictObjects\Scream;
use UselessSoft\Queries\Exception\InvalidArgumentException;
use UselessSoft\Queries\QueryHandlerInterface;
use UselessSoft\Queries\ResultSetInterface;
use UselessSoft\Queries\QueryHandlerChain;
use UselessSoftTests\Queries\Mocks\UserQuery;
use UselessSoftTests\Queries\Mocks\UserQueryHandler;
use Nette;
use Tester;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';


/**
 * @testCase
 */
class QueryHandlerTestCase extends Tester\TestCase
{
    use Scream;

	public function setUp() : void
	{

	}


	public function tearDown() : void
	{
		\Mockery::close();
	}


	public function testBasic() : void
	{
		$queryHandler = new QueryHandlerChain();
		$queryHandler->addHandler(new UserQueryHandler());

		Assert::true($queryHandler->supports(new UserQuery()));
		$result = $queryHandler->handle(new UserQuery());
		Assert::type(ResultSetInterface::class, $result);
		Assert::same([['name' => 'John'], ['name' => 'Jack']], iterator_to_array($result));
	}


	public function testUnsupportedQuery() : void
	{
		$queryHandler = new QueryHandlerChain();
		$queryHandler->addHandler(\Mockery::mock(QueryHandlerInterface::class)->shouldReceive('supports')->andReturn(FALSE)->getMock());
		Assert::false($queryHandler->supports(new UserQuery()));
		Assert::throws(function () use ($queryHandler) {
			$queryHandler->handle(new UserQuery());

		}, InvalidArgumentException::class, 'Unsupported query.');
	}

}


(new QueryHandlerTestCase())->run();
