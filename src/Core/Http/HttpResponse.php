<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/25
 */

namespace Autumn\Core\Http;

use Psr\Http\Message\ResponseInterface;

class HttpResponse extends HttpMessage implements ResponseInterface
{
    private int $statusCode = 0;
    private string $reasonPhrase = '';

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }

    public function withStatus(int $code, string $reasonPhrase = ''): static
    {
        if($code===$this->statusCode && ($reasonPhrase===$this->reasonPhrase)) {
            return $this;
        }

        $clone = clone $this;
        $clone->statusCode = $code;
        $clone->reasonPhrase = $reasonPhrase;
        return $clone;
    }
}