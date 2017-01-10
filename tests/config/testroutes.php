<?php

use Fermi\Response;
use Psr\Http\Message\RequestInterface;

$r->addRoute('GET', '/test-route', function (RequestInterface $request) {
    return Response::string('expected value');
});
