<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/10
 */

namespace Autumn\Http\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

class ForbiddenException extends Exception
{
    #[Pure]
    public function __construct($message = "Forbidden", $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}