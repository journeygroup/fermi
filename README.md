## About the Fermi Framework

[![Build Status](https://travis-ci.org/journeygroup/fermi.svg?branch=master)](https://travis-ci.org/journeygroup/fermi)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/journeygroup/fermi/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/journeygroup/fermi/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/journeygroup/fermi/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/journeygroup/fermi/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/journey/fermi/v/stable)](https://packagist.org/packages/journey/fermi)
[![License](https://poser.pugx.org/journey/fermi/license)](https://packagist.org/packages/journey/fermi)

Fermi is a [nuclear-sized](https://en.wikipedia.org/wiki/Femtometre) PSR-7 and PSR-15 compliant PHP framework. The goal of Fermi is to always be small enough, and transparent enough for novice developers to fully comprehend how it works, and expert developers to extend and modify it easily.


## Sure but why?

Fermi differs substantially from other PHP frameworks:

- It contains very little original code. In fact, you could think of it as a curated collection of excellent packages.
- B.Y.O.C. (bring your own container)... [or don’t](https://www.tonymarston.net/php-mysql/dependency-injection-is-evil.html).
- Hacking core is encouraged.

That last point probably made you 😳. Fermi core is a collection of stateless static methods that sits right alongside your project rather than hidden in the `vendor` directory. The framework is intended to serve more like scaffolding than an external dependency. Thanks to the great work of [PHP-FIG](http://www.php-fig.org/), we can rely on compliant packages instead of designing a new wheel.


## Installation

To create a new Fermi project, use Composer’s `create-project` command:

```sh
composer create-project journey/fermi your-new-app
```

You can then point an Apache virtual host to the public directory, or run Fermi with PHP’s built-in server:

```sh
php -S 127.0.0.1:8080 -t public public/index.php
```

## Base package selection

Fermi uses the following excellent open-source packages by default:

Function              | Package 
----------------------|--------
Messages              | [zendframework/zend-diactoros](https://github.com/zendframework/zend-diactoros)
Middleware Dispatcher | [mindplay/middleman](https://github.com/mindplay-dk/middleman)
Router                | [nikic/fast-route](https://github.com/nikic/FastRoute)
Templating            | [league/plates](https://github.com/thephpleague/plates)

Feel free to swap these out with any of your own packages.

## License

The Fermi framework is open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT).




