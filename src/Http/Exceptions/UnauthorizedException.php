<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/8/29
 */

namespace Autumn\Http\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

class UnauthorizedException extends Exception
{
    #[Pure]
    public function __construct($message = "Unauthorized", $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}