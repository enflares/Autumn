<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/25
 */

namespace Autumn\Core\Http;

use Psr\Http\Message\UriInterface;

class Uri implements UriInterface, JsonSerializable
{
    /**
     * Absolute http and https URIs require a host per RFC 7230 Section 2.7
     * but in generic URIs the host can be empty. So for http(s) URIs
     * we apply this default host when no host is given yet to form a
     * valid URI.
     */
    private const HTTP_DEFAULT_HOST = 'localhost';

    private const DEFAULT_PORTS = [
        'http' => 80,
        'https' => 443,
        'ftp' => 21,
        'gopher' => 70,
        'nntp' => 119,
        'news' => 119,
        'telnet' => 23,
        'tn3270' => 23,
        'imap' => 143,
        'pop' => 110,
        'ldap' => 389,
    ];

    private array $data;
    private string $url;

    public function __construct(string $uri = '')
    {
        if ($uri) {
            $this->data = parse_url($uri) ?: [];
        }

        $this->url = $uri;
    }

    public function __toString(): string
    {
        if (!$this->url) {
            $url = $this->getScheme() . '://';
            if ($userInfo = $this->getUserInfo()) {
                $url .= $userInfo . '@';
            }
            if ($authority = $this->getAuthority()) {
                $url .= $authority;
            } else {
                $host = $this->getHost();
                if (!$host && ($this->getScheme() === 'http' || $this->getScheme() === 'https')) {
                    $host = static::HTTP_DEFAULT_HOST;
                }
                $url .= $host;

                $port = $this->getPort();
                if ($port !== (static::DEFAULT_PORTS[$this->getScheme()] ?? null)) {
                    $url .= ':' . $port;
                }
            }
            $url .= $this->getPath();
            if ($query = $this->getQuery()) $url .= '?' . $query;
            if ($fragment = $this->getFragment()) $url .= '#' . $fragment;
            $this->url = $url;
        }

        return $this->url;
    }

    public function jsonSerialize(): mixed
    {
        return $this->__toString();
    }

    public function equals(mixed $any): bool
    {
        return (($any instanceof static)
                && ($any->data === $this->data))
            || ((string)$any === $this->url);
    }

    public function getScheme(): string
    {
        return $this->data['schema'] ?? '';
    }

    public function getAuthority(): string
    {
        return $this->data['authority'] ?? '';
    }

    public function getUserInfo(): string
    {
        return $this->data['userInfo'] ?? '';
    }

    public function getHost(): string
    {
        return $this->data['host'] ?? '';
    }

    public function getPort(): ?int
    {
        return $this->data['port'] ?? '';
    }

    public function getPath(): string
    {
        return $this->data['path'] ?? '';
    }

    public function getQuery(): string
    {
        return $this->data['query'] ?? '';
    }

    public function getFragment(): string
    {
        return $this->data['fragment'] ?? '';
    }

    public function withScheme(string $scheme): static
    {
        if (($scheme = strtolower($scheme)) === $this->getScheme()) {
            return $this;
        }

        $clone = clone $this;
        $clone->data['schema'] = $scheme;
        $clone->url = '';
        return $clone;
    }

    public function withUserInfo(string $user, string $password = null): static
    {
        if ($this->getUserInfo() === ($userInfo = trim("$user:$password", ':'))) {
            return $this;
        }

        $clone = clone $this;
        $clone->data['userInfo'] = $userInfo;
        $clone->url = '';
        return $clone;
    }

    public function withHost(string $host): static
    {
        if ($host === $this->getHost()) {
            return $this;
        }

        $clone = clone $this;
        $clone->data['host'] = $host;
        $clone->url = '';
        return $clone;
    }

    public function withPort(?int $port): static
    {
        if ($port === $this->getPort()) {
            return $this;
        }

        $clone = clone $this;
        $clone->data['port'] = $port;
        $clone->url = '';
        return $clone;
    }

    public function withPath(string $path): static
    {
        if ($path === $this->getPath()) {
            return $this;
        }

        $clone = clone $this;
        $clone->data['path'] = $path;
        $clone->url = '';
        return $clone;
    }

    public function withQuery(string $query): static
    {
        if ($query === $this->getQuery()) {
            return $this;
        }

        $clone = clone $this;
        $clone->data['query'] = $query;
        $clone->url = '';
        return $clone;
    }

    public function withFragment(string $fragment): static
    {
        if ($fragment === $this->getFragment()) {
            return $this;
        }

        $clone = clone $this;
        $clone->data['fragment'] = $fragment;
        $clone->url = '';
        return $clone;
    }

}