<?php

namespace Tests\Mocks;

use Fermi\Response;
use Psr\Http\Message\RequestInterface;

class MockMiddleware
{
    /**
     * Create a middleware invoke method.
     *
     * @param  Psr\Http\Message\RequestInterface $request PSR-7 Request
     * @param  callable         $next    method to call
     * @return Psr\Http\Message\ResponseInterface
     */
    public function __invoke(RequestInterface $request, callable $next)
    {
        return Response::string('expected output');
    }
}
