<?php

declare(strict_types=1);

namespace Librette\Queries\Exception;

use Kdyby\StrictObjects\Scream;

class InvalidArgumentException extends \LogicException
{
    use Scream;
}
