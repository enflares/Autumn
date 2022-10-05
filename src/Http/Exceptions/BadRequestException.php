<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/8/28
 */

namespace Autumn\Http\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

class BadRequestException extends Exception
{

    #[Pure]
    public function __construct($message = "Bad Request", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}