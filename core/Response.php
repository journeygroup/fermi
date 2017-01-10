<?php

namespace Fermi;

use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\TextResponse;

class Response
{
    /**
     * Returns a response with a particular view loaded.
     *
     * @param  string $view name of the view to load
     * @param  array  $data data to expose to the view
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function view($view, $data)
    {
        return new HtmlResponse(Framework::render($view, $data));
    }

    /**
     * Returns a response with a particular view loaded.
     *
     * @param  string $view name of the view to load
     * @param  array  $data data to expose to the view
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function json($data, $flags = 79)
    {
        return new HtmlResponse(JsonResponse($data, 200, [], $flags));
    }

    /**
     * Create a new basic string response.
     *
     * @param  string $name name of the view to load
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function string($string)
    {
        return new TextResponse($string);
    }

    /**
     * Respond with a 400 bad request error json message.
     *
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function error400(RequestInterface $request)
    {
        return static::string(["message" => "Bad Request"])->withStatus(400);
    }

    /**
     * Respond with a 402 error message.
     *
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function error402(RequestInterface $request)
    {
        return static::json(["message" => "Too Many Requests"])->withStatus(402);
    }

    /**
     * Respond with a 403 error message.
     *
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function error403(RequestInterface $request)
    {
        return static::string("Not Authorized")->withStatus(403);
    }

    /**
     * Respond with a 404 error message.
     *
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function error404(RequestInterface $request)
    {
        return static::string($request->getUri() . " was not found.")->withStatus(404);
    }

    /**
     * Respond with a 405 error message.
     *
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function error405(RequestInterface $request)
    {
        return static::string("Method " . $request->getMethod() . " not allowed")->withStatus(405);
    }
}
