<?php
/**
 * Autumn PHP Framework
 *
 * Date:        2022/10/5
 */

namespace Autumn\Http\Exceptions;

use JetBrains\PhpStorm\Pure;
use Throwable;

class ConflictException extends \InvalidArgumentException
{
    #[Pure]
    public function __construct($message = "Conflict", $code = 409, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}