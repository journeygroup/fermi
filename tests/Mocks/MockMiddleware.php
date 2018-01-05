<?php

namespace Tests\Mocks;

use Fermi\Response;
use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MockMiddleware implements MiddlewareInterface
{
    /**
     * Create a middleware invoke method.
     *
     * @param  Psr\Http\Message\ServerRequestInterface     $request PSR-7 request
     * @param  Interop\Http\Server\RequestHandlerInterface $handler PSR-15 request handler
     * @return Psr\Http\Message\ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        return Response::string('expected output');
    }
}
