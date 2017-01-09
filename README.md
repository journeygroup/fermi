Fermi Framework
---------------

Fermi is a [nuclear size](https://en.wikipedia.org/wiki/Femtometre) PSR-7 and PSR-15 compliant PHP framework intended to serve as glue for micro applications or apis. The goal of Fermi is to always be small enough, and transparent enough for novice developers to fully comprehend how it works, and expert developers to extend and modify it easily.

To achieve this goal, Fermi differs substantially from other PHP frameworks in a few key areas. First, it it contains very little original code. In fact you could almost think it as a currated collection of excellent opensource packages. Second, Fermi utilizes no application container. Although it would be trivial to add a container (and might be encouraged depending on your application) it is beyond the scope of this project, and often they are unecessary for small applications.

The third and most substantial difference between Fermi and other PHP frameworks is the open encouragement to modify core. Unlike other frameworks that are a collection of packages by the same author(s), all of the core Fermi code is along side your project rather than nestled in a `vendor` directory. The core framework is intended to serve more like scaffolding than a dependency. Thanks to the great standards being published by PHP-FIG it is no longer necessary for there to be a "framework specific" way of doing things.

Feel free to changes the default router ([FastRouter](https://github.com/nikic/FastRoute)), swap out the http implementation ([Diactoros](https://github.com/zendframework/zend-diactoros)), or even modify the core framework code. Your initial install is intended to have the same lifespan as your application and be trivial modify or even rewrite.

### Installation

To create a new Fermi project, use composers `create-project` command:

`composer create-project journey/fermi your-new-app`



