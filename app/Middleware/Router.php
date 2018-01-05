<?php

namespace App\Middleware;

use Fermi\Framework;
use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router implements MiddlewareInterface
{
    /**
     * Invoke the router via middleware.
     *
     * @param  Psr\Http\Message\ServerRequestInterface     $request PSR-7 compliant request.
     * @param  Interop\Http\Server\RequestHandlerInterface $handler PSR-15 compliant request handler.
     * @return Psr\Http\Message\ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return Framework::router($request);
    }
}
