<?php

declare(strict_types=1);

namespace LibretteTests\Queries;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\IQueryModifier;
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
		$handler = new MainQueryHandler();
		$query = new UserQuery();
		$handler->addModifier(\Mockery::mock(IQueryModifier::class)->shouldReceive('modify')->with($query)->once()->getMock());
		$handler->addHandler(new QueryHandler());
		$handler->fetch($query);

		Assert::true(TRUE);
	}

}


(new QueryModifierTestCase())->run();
