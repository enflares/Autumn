<?php
/**
 * Autumn PHP Framework
 *
 * Date:        2022/10/4
 */

namespace Autumn\Core\Container;

use Exception;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

class NotFoundException extends Exception implements NotFoundExceptionInterface
{
    public function __construct($message = "Not found", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}