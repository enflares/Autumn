<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/10/3
 */

namespace Autumn\Interfaces;

use ArrayAccess;

interface ArrayAccessInterface extends ArrayAccess
{
    public function offsetExists(mixed $offset): bool;

    public function offsetGet(mixed $offset): mixed;

    public function offsetSet(mixed $offset, mixed $value): void;

    public function offsetUnset(mixed $offset): void;
}