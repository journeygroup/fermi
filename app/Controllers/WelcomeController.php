<?php

namespace App\Controllers;

use Fermi\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class WelcomeController
{
    /**
     * Default Fermi handler.
     *
     * @param  Psr\Http\Message\ServerRequestInterface $request PSR-7 compliant request.
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function welcome(ServerRequestInterface $request): ResponseInterface
    {
        return Response::view('welcome/home', [
            'message' => 'Welcome to Fermi.'
        ]);
    }
}
