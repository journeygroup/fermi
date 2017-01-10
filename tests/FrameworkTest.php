<?php

namespace Tests;

use Closure;
use Fermi\Framework;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Request;

class FrameworkTest extends TestCase
{
    /**
     * Global variables before setUp().
     *
     * @var void
     */
    protected $globals;

    /**
     * Default host string.
     *
     * @var string
     */
    protected $host = "example.com";

    /**
     * Default uri path.
     *
     * @var string
     */
    protected $uri = "/test-route";

    /**
     * Setup our test environment
     *
     * @return void
     */
    protected function setUp()
    {
        $this->globals = [
            'server' => $_SERVER,
            'get' => $_GET,
            'post' => $_POST,
        ];
        $_SERVER['HTTP_HOST'] = "example.com";
        $_SERVER['REQUEST_URI'] = "/test-route";
    }

    /**
     * Tear down our test environment.
     *
     * @return void
     */
    protected function tearDown()
    {
        $_SERVER = $this->globals['server'];
        $_GET = $this->globals['get'];
        $_POST = $this->globals['post'];
        unset($this->globals);
    }

    /**
     * Tests the ability of createFromGlobals to return a new PSR-7 request.
     *
     * @return void
     */
    public function testRequestFromGlobals()
    {
        $request = Framework::requestFromGlobals();
        $this->assertInstanceOf(RequestInterface::class, $request);
        $this->assertEquals($request->getUri()->getHost(), $this->host);
        $this->assertEquals($request->getUri()->getPath(), $this->uri);
    }

    /**
     * Test the ability to load a new stack.
     *
     * @return void
     */
    public function testStack()
    {
        $stack = Framework::stack();
        
        $this->assertEquals(is_array($stack), true);
    }

    /**
     * Test the middleware's use of the lazy loading when strings are provided.
     *
     * @return void
     */
    public function testMiddlewareStrings()
    {
        $stack = Framework::middleware([
            'This is a string',
        ]);

        $this->assertEquals(is_callable($stack[0]), true);
    }

    /**
     * Test the middleware's use of the lazy loading when strings are provided.
     *
     * @return void
     */
    public function testMiddlewareClosures()
    {
        $stack = Framework::middleware([
            function (RequestInterface $request, callable $response) {
            }
        ]);

        $this->assertEquals(is_callable($stack[0]), true);
    }

    /**
     * Tests the frameworks lazy closure wrapper.
     *
     * @return void
     */
    public function testLazyWrapper()
    {
        $lazy = Framework::lazy('stdClass');
        $this->assertInstanceOf(Closure::class, $lazy);
    }

    /**
     * Test the route dispatcher.
     *
     * @return void
     */
    public function testRouteDispatcher()
    {
        $request = Framework::requestFromGlobals();
        $response = Framework::router($request, __DIR__ . "/config/testroutes.php");
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals($response->getBody(), 'expected value');
    }

    /**
     * Test the dispatcher for 404 requests.
     *
     * @return void
     */
    public function testRouteDispatcher404()
    {
        $_SERVER['REQUEST_URI'] = '/missing-path';
        $request = Framework::requestFromGlobals();
        $response = Framework::router($request, __DIR__ . "/config/testroutes.php");
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals($response->getStatusCode(), 404);
        $_SERVER['REQUEST_URI'] = $this->uri;
    }

    /**
     * Test the config ability to load by location.
     *
     * @return void
     */
    public function testConfigLoader()
    {
        $config = Framework::config('testconfig', __DIR__ . "/config");
        $this->assertInternalType('array', $config);
        $this->assertEquals($config[0], 'expected value');
    }

    /**
     * Tests the configuration loader's exception throwing.
     *
     * @return void
     */
    public function testConfigException()
    {
        $this->expectException(\InvalidArgumentException::class);
        Framework::config('.this-file-does-not-exist');
    }
}
