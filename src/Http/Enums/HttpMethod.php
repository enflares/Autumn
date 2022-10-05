<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/5
 */

namespace Autumn\Http\Enums;

enum HttpMethod: string
{
    case GET = "GET";
    case HEAD = "HEAD";
    case POST = "POST";
    case PUT = "PUT";
    case PATCH = "PATCH";
    case DELETE = "DELETE";
    case OPTIONS = "OPTIONS";
    case TRACE = "TRACE";

    public function matches(string|HttpMethod $method): bool
    {
        if($method instanceof self) {
            return $method->value === $this->value;
        }

        return $this->value == strtoupper($method);
    }
}