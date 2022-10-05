<?php
/**
 * Autumn PHP Framework
 *
 * Date:        2022/10/5
 */

namespace Autumn\System;

use Autumn\System\Interfaces\MiddlewareInterface;

class Route implements MiddlewareInterface
{

    public static function matches(Request $request): ?static
    {
        return null;
    }

    public function process(Request $request, callable $next): Response
    {
        return $request->getResponse();
    }
}