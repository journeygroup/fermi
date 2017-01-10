<?php

namespace Tests;

use Fermi\Framework;
use Fermi\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class ResponseTest extends TestCase
{
    /**
     * A request object to use during response.
     *
     * @var Psr\Http\Message\RequestInterface
     */
    protected $request;

    /**
     * Initial test setup.
     */
    public function setUp()
    {
        $this->request = Framework::requestFromGlobals();
    }

    /**
     * Test JSON Responses.
     *
     * @return void
     */
    public function testResponseJson()
    {
        $response = Response::json([
            'key' => 'value'
        ]);
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals($response->getHeaderLine('Content-Type'), 'application/json');
    }

    /**
     * Test a 400 bad request response.
     *
     * @return void
     */
    public function testResponse400()
    {
        $response = Response::error400($this->request);
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals($response->getStatusCode(), 400);
    }

    /**
     * Test a 403 Forbidden response.
     *
     * @return void
     */
    public function testResponse403()
    {
        $response = Response::error403($this->request);
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals($response->getStatusCode(), 403);
    }

    /**
     * Test a 429 Too Many Requests response.
     *
     * @return void
     */
    public function testResponse429()
    {
        $response = Response::error429($this->request);
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals($response->getStatusCode(), 429);
    }
}
