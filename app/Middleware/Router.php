<?php

namespace App\Middleware;

use Fermi\Framework;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Router implements MiddlewareInterface
{
    /**
     * Invoke the router via middleware.
     *
     * @param  Psr\Http\Message\ServerRequestInterface $request PSR-7 compliant request.
     * @param  Psr\Http\Server\RequestHandlerInterface $handler PSR-15 compliant middleware handler.
     * @return Psr\Http\Message\ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return Framework::router($request);
    }
}
