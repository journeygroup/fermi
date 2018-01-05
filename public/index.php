<?php

use Fermi\Framework;
use mindplay\middleman\Dispatcher;
use Zend\Diactoros\ServerRequestFactory;

/**
 * Fermi - A nuclear sized PSR-7 and PSR-15 compliant PHP framework.
 *
 * @package  Fermi
 * @author   Justin Schroeder <justins@journeygroup.com>
 */

/*
|--------------------------------------------------------------------------
| Autoloader.
|--------------------------------------------------------------------------
|
| Include the autoloader conveniently generated by composer.
|
*/

include __DIR__ . "/../vendor/autoload.php";

/*
|--------------------------------------------------------------------------
| Middleware dispatcher.
|--------------------------------------------------------------------------
|
| Initializes a middleware dispatcher. Fermi currently uses the lovely
| Middleman (mindplay/middleman) package, however any PSR-15 compliant
| middleware dispatcher would be acceptable.
|
*/

$dispatcher = new Dispatcher(Framework::stack());

/*
|--------------------------------------------------------------------------
| Middleware dispatch.
|--------------------------------------------------------------------------
|
| Now that we have our middleware stack loaded up with middleware, all we
| need to do is actually run through the stack. In the process we will
| initialize a new PSR-7 Request using the zend/diactoros package.
|
*/

$response = $dispatcher->dispatch(Framework::requestFromGlobals());

/*
|--------------------------------------------------------------------------
| Emit the HTTP response.
|--------------------------------------------------------------------------
|
| We should now have a PSR-7 response from the middleware stack. The last
| step in the process is to output the response to the server in order to
| return an actual HTTP response to a client. To do this we are using
| another zend/diacotoros class.
|
*/

(new Zend\Diactoros\Response\SapiEmitter())->emit($response);
