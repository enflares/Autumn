<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/8/28
 */

namespace Autumn\Http\Exceptions;

use Psr\Container\NotFoundExceptionInterface;
use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

class NotFoundException extends Exception implements NotFoundExceptionInterface
{
    #[Pure]
    public function __construct($message = "Not found", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}