<?php
/**
 * Autumn PHP Framework
 *
 * Date:        2022/10/5
 */

namespace Autumn\System\Interfaces;

use Autumn\System\Request;
use Autumn\System\Response;

interface FilterInterface
{
    public function doFilter(Request $request, Response $response, callable $next): Response;
}