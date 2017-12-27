<?php

namespace App\Middleware;

use Fermi\Framework;
use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Router implements MiddlewareInterface
{
    /**
     * Invoke the router via middleware.
     *
     * @param  Psr\Http\Message\RequestInterface $request PSR-7 compliant request.
     * @param  callable $next    delegate next callable method.
     * @return Psr\Http\Message\ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return Framework::router($request);
    }
}
