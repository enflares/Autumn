<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/25
 */

namespace Autumn\Core\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class HttpRequest extends HttpMessage implements RequestInterface
{
    private ?string $requestTarget = null;
    private ?string $method = null;
    private ?UriInterface $uri = null;

    public static function build(string $method, string $url=null, ?string $protocolVersion=null, ?string $target=null): static
    {
        $instance = new static($protocolVersion ?: '1.0');
        $instance->method = strtoupper($method);
        if($url) $instance->uri = new Uri($url);
        $instance->requestTarget = $target;
        return $instance;
    }

    public function getRequestTarget(): string
    {
        return $this->requestTarget;
    }

    public function withRequestTarget(string $requestTarget): static
    {
        if($this->requestTarget === $requestTarget) {
            return $this;
        }

        $clone = clone $this;
        $clone->requestTarget = $requestTarget;
        return $clone;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function withMethod(string $method): static
    {
        if(($method = strtoupper($method))===$this->method) {
            return $this;
        }

        $clone = clone $this;
        $clone->method = $method;
        return $clone;
    }

    public function getUri(): UriInterface
    {
        return $this->uri;
    }

    public function withUri(UriInterface $uri, bool $preserveHost): static
    {
        if($uri->equals($this->uri)) {
            return $this;
        }

        $clone = clone $this;
        $clone->uri = $uri;
        return $clone;
    }
}