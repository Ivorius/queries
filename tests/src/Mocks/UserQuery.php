<?php

declare(strict_types=1);

namespace LibretteTests\Queries\Mocks;

use Kdyby\StrictObjects\Scream;
use Librette\Queries\QueryInterface;

/**
 * @author David Matejka
 */
class UserQuery implements QueryInterface
{
    use Scream;
}
