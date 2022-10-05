<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/10/3
 */

namespace Autumn\Interfaces;

interface ObjectAccessInterface
{
    public function __get(string $name);

    public function __set(string $name, $value): void;

    public function __isset(string $name): bool;

    public function __unset(string $name): void;
}