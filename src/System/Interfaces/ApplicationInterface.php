<?php
/**
 * Autumn PHP Framework
 *
 * Date:        2022/10/5
 */

namespace Autumn\System\Interfaces;

use Autumn\Interfaces\Runnable;

interface ApplicationInterface extends Runnable
{
    public function forClass(string $class): string;
}