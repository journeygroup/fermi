<?php

namespace App\Middleware;

use Fermi\Framework;
use Psr\Http\Message\RequestInterface as Request;

class Router
{
    /**
     * Invoke the router via middleware.
     *
     * @param  Psr\Http\Message\RequestInterface $request PSR-7 compliant request.
     * @param  callable $next    delegate next callable method.
     * @return Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, callable $next)
    {
        return Framework::router($request);
    }
}
