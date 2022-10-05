<?php
/**
 * Autumn PHP Framework
 *
 * Date:        2022/10/4
 */

namespace Autumn\Core\Cache;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class CacheItemPool implements CacheItemPoolInterface
{
    private array $items = [];
    private array $deferred = [];

    public static function validateKey(string $key): string
    {
        return $key;
    }

    public function getItem(string $key): CacheItemInterface
    {
        if ($key = static::validateKey($key)) {
            return $this->items[$key] ?? new CacheItem($key, null, false);
        }

        throw new InvalidArgumentException();
    }

    public function getItems(array $keys = []): iterable
    {
        foreach ($keys as $key) {
            yield $this->getItem($key);
        }
    }

    public function hasItem(string $key): bool
    {
        if ($key = static::validateKey($key)) {
            return isset($this->items[$key]);
        }

        throw new InvalidArgumentException();
    }

    public function clear(): bool
    {
        $this->items = [];
        return true;
    }

    public function deleteItem(string $key): bool
    {
        if ($key = static::validateKey($key)) {
            unset($this->items[$key]);
            return true;
        }

        throw new InvalidArgumentException();
    }

    public function deleteItems(array $keys): bool
    {
        foreach ($keys as $key) {
            $this->deleteItem($key);
        }

        return true;
    }

    public function save(CacheItemInterface $item): bool
    {

    }

    public function saveDeferred(CacheItemInterface $item): bool
    {
        $this->items[$key = $item->getKey()] = $item;
        if (!in_array($key, $this->deferred)) {
            $this->deferred[] = $key;
        }
        return true;
    }

    public function commit(): bool
    {
        foreach ($this->deferred as $key) {
            $this->save($this->items[$key]);
        }

        $this->deferred = [];
        return true;
    }
}