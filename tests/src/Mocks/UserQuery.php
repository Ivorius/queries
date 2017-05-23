<?php

declare(strict_types=1);

namespace UselessSoftTests\Queries\Mocks;

use Kdyby\StrictObjects\Scream;
use UselessSoft\Queries\QueryInterface;

class UserQuery implements QueryInterface
{
    use Scream;
}
