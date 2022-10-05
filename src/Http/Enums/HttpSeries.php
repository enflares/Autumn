<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/5
 */

namespace Autumn\Http\Enums;

/**
 * Class HttpSeries
 *
 * Enumeration of HTTP status series.
 *
 * @package     enflares\Net\Enums
 * @since       2022/9/5
 */
enum HttpSeries: int
{
    case INFORMATIONAL = 1;
    case SUCCESSFUL = 2;
    case REDIRECTION = 3;
    case CLIENT_ERROR = 4;
    case SERVER_ERROR = 5;
}