<?php
/**
 * Autumn PHP Framework
 *
 * Date:        2022/10/4
 */

namespace Autumn\Core\Cache;

use DateInterval;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use Psr\Cache\CacheItemInterface;

class CacheItem implements CacheItemInterface
{
    protected ?DateTimeInterface $expiration = null;

    public function __construct(
        protected string $key,
        protected mixed  $value = null,
        protected bool $hit = false
    )
    {
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function isHit(): bool
    {
        return $this->hit;
    }

    public function get(): mixed
    {
        return $this->isHit() ? $this->value : null;
    }

    public function set(mixed $value): static
    {
        $this->value = $value;
        return $this;
    }

    public function expiresAt(?DateTimeInterface $expiration): static
    {
        $this->expiration = $expiration ?: new DateTimeImmutable('now +1 year');
        return $this;
    }

    /**
     * @throws Exception
     */
    public function expiresAfter(DateInterval|int|null $time): static
    {
        $this->expiration = match(true) {
            is_null($time) => new DateTimeImmutable('now +1 year'),
            is_int($time) => new DateTimeImmutable('now +' . $time . ' seconds'),
            $time instanceof DateInterval => (new DateTimeImmutable())->add($time),
        };

        return $this;
    }
}