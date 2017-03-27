<?php

namespace App\Middleware;

use Fermi\Framework;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router implements MiddlewareInterface
{
    /**
     * Invoke the router via middleware.
     *
     * @param  Psr\Http\Message\RequestInterface $request PSR-7 compliant request.
     * @param  callable $next    delegate next callable method.
     * @return Psr\Http\Message\ResponseInterface
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        return Framework::router($request);
    }
}
