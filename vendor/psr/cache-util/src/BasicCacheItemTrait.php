<?php

namespace Fig\Cache;

use Exception;
use JetBrains\PhpStorm\Pure;
use Psr\Cache\CacheItemInterface;

/**
 * Basic implementation of a backend-agnostic cache item.
 *
 * @implements CacheItemInterface
 */
trait BasicCacheItemTrait
{

    protected string $key;

    protected mixed $value;

    protected bool $hit;

    protected ?\DateTimeInterface $expiration;

    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * {@inheritdoc}
     */
    #[Pure]
    public function get(): mixed
    {
        return $this->isHit() ? $this->value : null;
    }

    /**
     * {@inheritdoc}
     */
    public function set($value = null): static
    {
        $this->value = $value;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isHit(): bool
    {
        return $this->hit;
    }

    /**
     * {@inheritdoc}
     */
    public function expiresAt(?\DateTimeInterface $expiration): static
    {
        $this->expiration = $expiration ?? new \DateTimeImmutable('now +1 year');

        return $this;
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function expiresAfter(int|\DateInterval|null $time): static
    {
        $this->expiration = match(true) {
            is_null($time) => new \DateTimeImmutable('now +1 year'),
            is_int($time) => new \DateTimeImmutable('now +' . $time . ' seconds'),
            $time instanceof \DateInterval => (new \DateTimeImmutable())->add($time),
        };
        return $this;
    }
}
