<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/25
 */

namespace Autumn\Core\Http;

use Autumn\Http\HttpCookie;
use Psr\Http\Message\StreamInterface;
use Stringable;

abstract class ServerResponse extends HttpResponse
{
    public const DEFAULT_PROTOCOL_VERSION = '1.0';

    private array $cookies = [];
    private mixed $content = null;

    private string $protocol = 'HTTP';

    public abstract function send(mixed $content = null): void;

    public function setContentType(string $contentType, ?string $charset = null): void
    {
        if ($charset) $contentType .= '; charset=' . $charset;
        $this->setHeader('Content-Type', $contentType);
    }

    /**
     * @return HttpCookie[]
     */
    public function getCookies(): array
    {
        return $this->cookies;
    }

    public function hasCookie(string $name): bool
    {
        return isset($this->cookies[$name]);
    }

    public function setCookie(
        string|HttpCookie $cookie,
        mixed             $value = null,
        int               $expires = 0,
        ?string           $path = '/',
        ?string           $domain = null,
        bool              $secure = false,
        bool              $httpOnly = false,
        ?string           $sameSite = null,
    ): void
    {
        if (is_string($cookie)) {
            $cookie = new HttpCookie(...func_get_args());
        }

        $this->cookies[$cookie->getName()] = $cookie;
    }

    /**
     * @return mixed
     */
    #[Pure]
    public function getContent(): mixed
    {
        return $this->content;
    }

    /**
     * @param mixed|null $content
     */
    public function setContent(mixed $content): void
    {
        if ($content instanceof StreamInterface) {
            $this->content = null;
        } else {
            $this->content = $content;
        }
    }

    public function redirect(string|Stringable $uri, int $status = 302): static
    {
        $response = $this->withStatus($status);
        $response->setHeader('location', (string)$uri);
        $response->setContent(null);
        return $response;
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return $this->protocol;
    }

    /**
     * @param string $protocol
     */
    public function setProtocol(string $protocol): void
    {
        $this->protocol = $protocol;
    }

}