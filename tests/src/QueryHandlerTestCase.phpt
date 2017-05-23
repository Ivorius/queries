<?php

declare(strict_types=1);

namespace LibretteTests\Queries;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\Exception\InvalidArgumentException;
use Librette\Queries\QueryHandlerInterface;
use Librette\Queries\ResultSetInterface;
use Librette\Queries\QueryHandlerChain;
use LibretteTests\Queries\Mocks\UserQuery;
use LibretteTests\Queries\Mocks\UserQueryHandler;
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
		$result = $queryHandler->fetch(new UserQuery());
		Assert::type(ResultSetInterface::class, $result);
		Assert::same([['name' => 'John'], ['name' => 'Jack']], iterator_to_array($result));
	}


	public function testUnsupportedQuery() : void
	{
		$queryHandler = new QueryHandlerChain();
		$queryHandler->addHandler(\Mockery::mock(QueryHandlerInterface::class)->shouldReceive('supports')->andReturn(FALSE)->getMock());
		Assert::false($queryHandler->supports(new UserQuery()));
		Assert::throws(function () use ($queryHandler) {
			$queryHandler->fetch(new UserQuery());

		}, InvalidArgumentException::class, 'Unsupported query.');
	}

}


(new QueryHandlerTestCase())->run();
