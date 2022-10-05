<?php
/**
 * Autumn PHP Framework
 *
 * Date:        2022/10/5
 */

namespace Autumn\System;

use Autumn\App;
use Autumn\System\Interfaces\FilterInterface;

class FilterChain implements FilterInterface
{
    protected array $filters = [];

    public final function doFilter(Request $request, Response $response, callable $next): Response
    {
        $this->onFilter($request, $response);

        foreach ($this->filters as $filter) {
            if ($filter = App::instance($filter, FilterInterface::class, true)) {
                $next = function (Request $request, Response $response) use ($filter, $next) {
                    return $filter->doFilter($request, $response, $next);
                };
            }
        }

        $next = function (Request $request, Response $response) use ($next) {
            return $this->filter($request, $response, $next);
        };

        return call_user_func($next, $request, $response);
    }

    public function addFilter(string|FilterInterface ...$filters): void
    {
        foreach($filters as $filter) {
            if(!in_array($filter,$this->filters, true)) {
                $this->filters[] = $filter;
            }
        }
    }

    protected function onFilter(Request $request, Response $response): void
    {

    }

    public function filter(Request $request, Response $response, callable $next): Response
    {
        return call_user_func($next, $request, $response);
    }
}