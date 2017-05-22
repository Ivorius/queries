<?php

declare(strict_types=1);

namespace LibretteTests\Queries;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\CountQuery;
use Librette\Queries\CountQueryHandler;
use Librette\Queries\QueryHandlerChain;
use Librette\Queries\SingleItemQuery;
use Librette\Queries\SingleItemQueryHandler;
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
