<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/10/4
 */

namespace Autumn\Http\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;
use Stringable;
use Throwable;

class RedirectException extends Exception
{
    private string|Stringable $url;
    private array $parameters = [];

    #[Pure]
    public function __construct($message = "Moved Permanently", $code = 301, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function make(string|Stringable $url, array $parameters=null): static
    {
        $instance = new static;
        $instance->setUrl($url);
        if($parameters) $instance->setParameters($parameters);
        return $instance;
    }

    /**
     * @return string|Stringable
     */
    public function getUrl(): Stringable|string
    {
        if($this->parameters) {
            return $this->url . '?' . http_build_query($this->parameters);
        }

        return $this->url;
    }

    /**
     * @param string|Stringable $url
     */
    public function setUrl(Stringable|string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     */
    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }
}