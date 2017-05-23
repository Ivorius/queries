<?php

declare(strict_types=1);

namespace LibretteTests\Queries;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\QueryBus;
use Librette\Queries\QueryHandlerInterface;
use Librette\Queries\QueryInterface;
use Tester;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';


/**
 * @testCase
 */
class QueryBusTestCase extends Tester\TestCase
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
		$queryHandler = \Mockery::mock(QueryHandlerInterface::class);
		$query = \Mockery::mock(QueryInterface::class);

		$queryHandler->shouldReceive('fetch')->with($query)->andReturn(123);
		$queryHandler->shouldReceive('supports')->with($query)->andReturn(TRUE);

		$bus = new QueryBus($queryHandler);
		Assert::true($bus->supports($query));
		$result = $bus->fetch($query);
		Assert::same(123, $result);
	}

}


(new QueryBusTestCase())->run();
