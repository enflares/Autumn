<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/25
 */

namespace Autumn\Core\Http;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

class HttpMessage implements MessageInterface
{
    private StreamInterface $body;
    private ?array $headers = [];

    public function __construct(
        readonly private string $protocolVersion
    )
    {

    }

    protected function setBody(StreamInterface $stream): void
    {
        $this->body = $stream;
    }

    /**
     * @return string
     */
    public function getProtocolVersion(): string
    {
        return $this->protocolVersion;
    }

    public function withProtocolVersion(string $version): static
    {
        if ($version === $this->protocolVersion) return $this;

        $clone = clone $this;
        $clone->protocolVersion = $version;
        return $clone;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function hasHeader(string $name): bool
    {
        return $this->headers[strtolower($name)];
    }

    public function getHeader(string $name): array
    {
        $values = [];
        foreach ($this->headers[strtolower($name)] ?? [] as $key => $value) {
            $values[] = $value;
        }
        return $values;
    }

    public function getHeaderLine(string $name): string
    {
        return implode(',', $this->getHeader($name));
    }

    public function setHeader(string $name, array|string $value): void
    {
        $this->removeHeader($name);
        $this->addHeader($name, $value);
    }

    public function addHeader(string $name, array|string|int|float $value): void
    {
        if (is_array($value)) $value = implode(',', $value);
        $this->headers[strtolower($name)] = [$name => $value];
    }

    public function removeHeader(string $name): void
    {
        unset($this->headers[strtolower($name)]);
    }

    public function withHeader(string $name, array|string|int|float $value): static
    {
        if (is_string($value)) $value = [$value];

        $clone = clone $this;
        $clone->headers = [];
        $clone->addHeader($name, $value);
        return $clone;
    }

    public function withAddedHeader(string $name, array|string $value): static
    {
        if (is_string($value)) $value = [$value];
        if (array_diff($value, $this->getHeader($name))) {
            return $this;
        }

        $clone = clone $this;
        $clone->setHeader($name, $value);
        return $clone;
    }

    public function withoutHeader(string $name): static
    {
        $clone = clone $this;
        $clone->removeHeader($name);
        return $clone;
    }

    /**
     * @return StreamInterface
     */
    public function getBody(): StreamInterface
    {
        return $this->body;
    }

    public function withBody(StreamInterface $body): static
    {
        if ($body === $this->body) {
            return $this;
        }

        $clone = clone $this;
        $clone->body = $body;
        return $clone;
    }
}