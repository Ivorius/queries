<?php

declare(strict_types=1);

namespace UselessSoft\Queries\Exception;

use Kdyby\StrictObjects\Scream;

class InvalidStateException extends \RuntimeException implements ExceptionInterface
{
    use Scream;
}
