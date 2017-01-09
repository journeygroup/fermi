<?php

namespace App\Controllers;

use Fermi\Response;
use Psr\Http\Message\RequestInterface as Request;

class WelcomeController
{
    /**
     * Default Fermi hander.
     *
     * @param  Psr\Http\Message\RequestInterface  $request  The request http object
     * @param  Psr\Http\Message\ResponseInterface $response The response http object
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function welcome(Request $request)
    {
        return Response::view('welcome/home', [
            'message' => 'Welcome to Fermi.'
        ]);
    }
}
