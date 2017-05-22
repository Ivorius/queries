<?php

declare(strict_types=1);

namespace LibretteTests\Queries;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\QueryModifierInterface;
use Librette\Queries\QueryHandlerChain;
use LibretteTests\Queries\Mocks\UserQuery;
use LibretteTests\Queries\Mocks\UserQueryHandler;
use Nette;
use Tester;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';


/**
 * @author David Matějka
 * @testCase
 */
class QueryModifierTestCase extends Tester\TestCase
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
		$handler = new QueryHandlerChain();
		$query = new UserQuery();
		$handler->addModifier(\Mockery::mock(QueryModifierInterface::class)->shouldReceive('modify')->with($query)->once()->getMock());
		$handler->addHandler(new UserQueryHandler());
		$handler->fetch($query);

		Assert::true(TRUE);
	}

}


(new QueryModifierTestCase())->run();
