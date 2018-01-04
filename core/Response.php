<?php

declare(strict_types = 1);

namespace Fermi;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\TextResponse;

class Response
{
    /**
     * Returns a response with a particular view loaded.
     *
     * @param  string $view name of the view to load
     * @param  array  $data data to expose to the view
     * @param  Engine $engine alternative rendering engine
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function view(string $view, array $data, Engine $engine = null): ResponseInterface
    {
        return new HtmlResponse(Framework::render($view, $data, $engine));
    }

    /**
     * Returns a response with a particular view loaded.
     *
     * @param  mixed $json  JSON serializable data
     * @param  int   $flags JSON flags
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function json($data, int $flags = 79): ResponseInterface
    {
        return new JsonResponse($data, 200, [], $flags);
    }

    /**
     * Create a new basic string response.
     *
     * @param  string $string string to respond
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function string(string $string): ResponseInterface
    {
        return new TextResponse($string);
    }

    /**
     * Respond with a 400 bad request error json message.
     *
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function error400(ServerRequestInterface $request): ResponseInterface
    {
        return static::json(["message" => "Bad Request"])->withStatus(400);
    }

    /**
     * Respond with a 403 error message.
     *
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function error403(ServerRequestInterface $request): ResponseInterface
    {
        return static::string("Not Authorized")->withStatus(403);
    }

    /**
     * Respond with a 404 error message.
     *
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function error404(ServerRequestInterface $request): ResponseInterface
    {
        return static::string($request->getUri() . " was not found.")->withStatus(404);
    }

    /**
     * Respond with a 405 error message.
     *
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function error405(ServerRequestInterface $request): ResponseInterface
    {
        return static::string("Method " . $request->getMethod() . " not allowed")->withStatus(405);
    }

    /**
     * Respond with a 429 error message.
     *
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function error429(ServerRequestInterface $request): ResponseInterface
    {
        return static::json(["message" => "Too Many Requests"])->withStatus(429);
    }
}
