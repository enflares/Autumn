<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/25
 */

namespace Autumn\Core\Http;

use ArrayAccess;
use Autumn\Http\Enums\HttpMethod;
use Psr\Http\Message\ServerRequestInterface;

class ServerRequest extends HttpRequest implements ServerRequestInterface, ArrayAccess
{
    private array $serverParams = [];
    private array $cookieParams = [];
    private array $queryParams = [];
    private array $uploadedFiles = [];
    private array $attributes = [];

    private string $protocol;
    private object|array|null $parsedBody = null;

    public static function capture(array $attributes = null): static
    {
        static $instance;
        if (!$instance) {
            $isHttps = (($_SERVER['SERVER_PORT'] ?? null) === 443)
                || !strcasecmp($_SERVER['HTTPS'] ?? '', 'on')
                || !strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? $_SERVER['REQUEST_SCHEME'] ?? '', 'https');

            $url = ($isHttps ? 'http' : 'https') . '://'
                . ($_SERVER['HTTP_HOST'] ?? trim($_SERVER['SERVER_NAME'] ?? '' . ':' . ($_SERVER['SERVER_PORT'] ?? ''), ':'))
                . ($_SERVER['REQUEST_URI'] ?? null);

            $protocol = explode('/', $_SERVER['SERVER_PROTOCOL'] ?? '');
            $instance = static::build($_SERVER['REQUEST_METHOD'], $url, $protocol[1] ?? '');
            $instance->protocol = $protocol[0];

            $instance->serverParams = $_SERVER;
            $instance->cookieParams = $_COOKIE;
            $instance->queryParams = $_REQUEST;
            $instance->uploadedFiles = $_FILES;
            $instance->attributes = $attributes ?: [];

            foreach ($_SERVER as $name => $value) {
                if (str_starts_with($name, 'HTTP_')) {
                    $instance->setHeader(substr($name, 5), $value);
                }
            }
        }

        return $instance;
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return $this->protocol;
    }

    public function getHttpMethod(): HttpMethod
    {
        return HttpMethod::tryFrom(strtoupper($this->getMethod() ?: 'GET'));
    }

    /**
     * @return array
     */
    public function getServerParams(): array
    {
        return $this->serverParams;
    }

    /**
     * @return array
     */
    public function getCookieParams(): array
    {
        return $this->cookieParams;
    }

    /**
     * @return array
     */
    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    /**
     * @return array
     */
    public function getUploadedFiles(): array
    {
        return $this->uploadedFiles;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return array|object|null
     */
    public function getParsedBody(): object|array|null
    {
        return $this->parsedBody;
    }

    public function withCookieParams(array $cookies): static
    {
        $clone = clone $this;
        $clone->cookieParams = $cookies;
        return $clone;
    }

    public function withQueryParams(array $query): static
    {
        $clone = clone $this;
        $clone->queryParams = $query;
        return $clone;
    }

    public function withUploadedFiles(array $uploadedFiles): static
    {
        $clone = clone $this;
        $clone->uploadedFiles = $uploadedFiles;
        return $clone;
    }

    public function withParsedBody(object|array|null $data): static
    {
        $clone = clone $this;
        $clone->parsedBody = $data;
        return $clone;
    }

    public function getAttribute(string $name, mixed $default = null): mixed
    {
        return $this->attributes[$name] ?? $default;
    }

    public function setAttribute(string $name, mixed $value): void
    {
        $this->attributes[$name] = $value;
    }

    public function withAttribute(string $name, mixed $value): static
    {
        if ($this->getAttribute($name) === $value) {
            return $this;
        }

        $clone = clone $this;
        $clone->attributes[$name] = $value;
        return $clone;
    }

    public function withoutAttribute(string $name): static
    {
        if (!isset($this->attributes[$name])) {
            return $this;
        }

        $clone = clone $this;
        unset($this->attributes[$name]);
        return $clone;
    }

    public function withAttributes(array $attributes): static
    {
        $diff = [];
        foreach ($attributes as $name => $value) {
            if ($value !== ($this->attributes[$name] ?? null)) {
                $diff[$name] = $value;
            }
        }

        if (empty($diff)) return $this;

        $clone = clone $this;
        $clone->attributes = array_merge($this->attributes, $diff);
        return $clone;
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->attributes[$offset])
            || isset($this->queryParams[$offset])
            || isset($this->parsedBody[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->attributes[$offset]
            ?? $this->queryParams[$offset]
            ?? $this->parsedBody[$offset]
            ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->attributes[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->attributes[$offset]);
        unset($this->queryParams[$offset]);
        unset($this->parsedBody[$offset]);
    }

    public function some(string ...$names): array
    {
        $result = [];
        foreach ($names as $name) {
            $result[$name] = $this->offsetGet($name);
        }
        return $result;
    }

    public function entries(): array
    {
        return array_merge((array)$this->parsedBody, $this->queryParams, $this->attributes);
    }

    public function values(string ...$names): array
    {
        if (empty($names)) {
            return array_values($this->entries());

        } else {
            $result = [];
            foreach ($names as $name) {
                $result[] = $this->offsetGet($name);
            }
            return $result;
        }
    }

    public function any(string ...$names): mixed
    {
        foreach ($names as $name) {
            $value = $this->offsetGet($name);
            if ($value !== '' && $value !== null) {
                return $value;
            }
        }

        return null;
    }

    #[Pure]
    public function getCookie(string $name, string $default = null): string
    {
        return $this->getCookieParams()[$name] ?? $default ?: '';
    }
}