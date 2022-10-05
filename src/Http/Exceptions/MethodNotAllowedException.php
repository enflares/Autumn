<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/10/2
 */

namespace Autumn\Http\Exceptions;

use JetBrains\PhpStorm\Pure;
use Throwable;

class MethodNotAllowedException extends \Exception
{
    #[Pure]
    public function __construct($message = "Method Not Allowed", $code = 405, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}