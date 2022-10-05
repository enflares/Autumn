<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/23
 */

namespace Autumn\Interfaces;

interface Runnable
{
    public function run(): void;

    public function end(): void;
}