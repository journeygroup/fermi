<?php

namespace Tests\Mocks;

use Fermi\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MockMiddleware implements MiddlewareInterface
{
    /**
     * Create a middleware invoke method.
     *
     * @param  Psr\Http\Message\ServerRequestInterface     $request PSR-7 request
     * @param  Psr\Http\Server\RequestHandlerInterface     $handler PSR-15 request handler
     * @return Psr\Http\Message\ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        return Response::string('expected output');
    }
}
