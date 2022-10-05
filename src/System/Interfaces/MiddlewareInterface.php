<?php
/**
 * Autumn PHP Framework
 *
 * Date:        2022/10/5
 */

namespace Autumn\System\Interfaces;

use Autumn\System\Request;
use Autumn\System\Response;

interface MiddlewareInterface
{
    public function process(Request $request, callable $next): Response;
}