<?php

declare(strict_types=1);

namespace UselessSoft\Queries\Exception;

use Kdyby\StrictObjects\Scream;

class InvalidArgumentException extends \LogicException implements ExceptionInterface
{
    use Scream;
}
