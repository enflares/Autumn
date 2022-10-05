<?php
/**
 * Autumn PHP Framework
 *
 * Date:        2022/10/5
 */

namespace Autumn\System;

use Autumn\Core\Http\ServerRequest;

class Request extends ServerRequest
{
    private ?Route $route = null;
    private ?Response $response = null;

    public static function capture(): static
    {
        return new static;
    }

    /**
     * @return Route|null
     */
    public function getRoute(): ?Route
    {
        return $this->route;
    }

    /**
     * @param Route|null $route
     */
    public function setRoute(?Route $route): void
    {
        $this->route = $route;
    }

    /**
     * @return Response|null
     */
    public function getResponse(): ?Response
    {
        return $this->response;
    }

    /**
     * @param Response|null $response
     */
    public function setResponse(?Response $response): void
    {
        $this->response = $response;
    }


}