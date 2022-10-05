<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/23
 */

namespace Autumn\Interfaces;

interface SingletonInterface
{
    public static function getInstance(): static;
}