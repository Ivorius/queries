<?php

declare(strict_types=1);

namespace LibretteTests\Queries;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\InvalidArgumentException;
use Librette\Queries\QueryHandlerInterface;
use Librette\Queries\ResultSetInterface;
use Librette\Queries\MainQueryHandler;
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
		$queryHandler = new MainQueryHandler();
		$queryHandler->addHandler(new QueryHandler());

		Assert::true($queryHandler->supports(new UserQuery()));
		$result = $queryHandler->fetch(new UserQuery());
		Assert::type(ResultSetInterface::class, $result);
		Assert::same([['name' => 'John'], ['name' => 'Jack']], iterator_to_array($result));
	}


	public function testUnsupportedQuery() : void
	{
		$queryHandler = new MainQueryHandler();
		$queryHandler->addHandler(\Mockery::mock(QueryHandlerInterface::class)->shouldReceive('supports')->andReturn(FALSE)->getMock());
		Assert::false($queryHandler->supports(new UserQuery()));
		Assert::throws(function () use ($queryHandler) {
			$queryHandler->fetch(new UserQuery());

		}, InvalidArgumentException::class, 'Unsupported query.');
	}

}


(new QueryHandlerTestCase())->run();
