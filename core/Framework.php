<?php

namespace Fermi;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequestFactory;

class Framework
{
    /**
     * Create a new request from the php globals environment.
     *
     * Note: If you want to use a different PSR-7 implementation this would be
     * the proper place to replace the stock implementation of zend\diactoros.
     *
     * @return Psr\Http\Message\ServerRequestInterface
     */
    public static function requestFromGlobals(): ServerRequestInterface
    {
        return ServerRequestFactory::fromGlobals();
    }

    /**
     * Returns the full middleware stack.
     *
     * @return array
     */
    public static function stack(): array
    {
        return static::config('middleware');
    }

    /**
     * Create a middleware stack that is resolvable by PSR-15.
     *
     * @param  array $stack array of callables or strings.
     * @return array
     */
    public static function middleware(array $stack): array
    {
        return array_map(function ($callable) {
            $callable = is_string($callable) ? static::lazy($callable) : $callable;
            return $callable;
        }, $stack);
    }

    /**
     * Returns a closure which, when called, will create an instance of the
     * class passed to it and then call __invoke() with middleware arguments.
     *
     * @param  string   $className fully qualified name of a class
     * @return callable
     */
    public static function lazy(string $className): callable
    {
        return function (ServerRequestInterface $request, RequestHandlerInterface $handler) use ($className): ResponseInterface {
            $class = new $className();
            if ($class instanceof MiddlewareInterface) {
                return $class->process($request, $handler);
            } else {
                return $class($request, $handler);
            }
        };
    }

    /**
     * Use FastRouter\simpleDispatcher to collect the routes into a FastRoute\Dispatcher.
     *
     * @param  Psr\Http\Message\ServerRequestInterface $request
     * @param  string                                  $path
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function router(ServerRequestInterface $request, string $path = null): ResponseInterface
    {
        $path = $path ?: __DIR__ . "/../app/routes.php";
        $dispatcher = \FastRoute\simpleDispatcher(function (RouteCollector $r) use ($path) {
            include $path;
        });
        $match = $dispatcher->dispatch($request->getMethod(), $request->getUri()->getPath());
        return static::resolve($request, $match);
    }

    /**
     * Resolve an HTTP request match.
     *
     * @param  Psr\Http\Message\ServerRequestInterface $request
     * @param  array                                   $match Route match. When using fast router will be array.
     * @return Psr\Http\Message\ResponseInterface
     */
    public static function resolve(ServerRequestInterface $request, array $match): ResponseInterface
    {
        switch ($match[0]) {
            case Dispatcher::FOUND:
                array_unshift($match[2], $request);
                return call_user_func_array($match[1], $match[2]);
            case Dispatcher::METHOD_NOT_ALLOWED:
                return Response::error405($request);
            default:
                return Response::error404($request);
        }
    }

    /**
     * Load a given configuration file or array.
     *
     * @param  string $name config file name
     * @param  string $dir  path to directory storing the config file
     * @return array
     */
    public static function config(string $name, string $dir = null): array
    {
        $dir = $dir ?: __DIR__ . "/../config";
        $location = rtrim($dir, "/") . "/" . ltrim($name, "/") . ".php";
        if (!file_exists($location)) {
            throw new \InvalidArgumentException('Requested configuration file does not exist: ' . $location);
        }
        $config = include $location;
        if (!is_array($config)) {
            throw new \InvalidArgumentException('Requested configuration file does not return an array: ' . $location);
        }
        return $config;
    }

    /**
     * Get the rendering engine.
     *
     * @return League\Plates\Engine
     */
    public static function engine(): Engine
    {
        return new Engine(__DIR__ . "/../views");
    }

    /**
     * Render a given view with our template engine.
     *
     * @param  string $view   our view data.
     * @param  array  $data   data to pass through to our template
     * @param  Engine $engine alternative rendering engine
     * @return string
     */
    public static function render(string $view, array $data, Engine $engine = null): string
    {
        $engine = ($engine instanceof Engine) ? $engine : static::engine();
        return $engine->render($view, $data);
    }
}
