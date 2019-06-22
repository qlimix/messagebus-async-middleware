# Messagebus-async-middleware

[![Travis CI](https://api.travis-ci.org/qlimix/messagebus-async-middleware.svg?branch=master)](https://travis-ci.org/qlimix/messagebus-async-middleware)
[![Coveralls](https://img.shields.io/coveralls/github/qlimix/messagebus-async-middleware.svg)](https://coveralls.io/github/qlimix/messagebus-async-middleware)
[![Packagist](https://img.shields.io/packagist/v/qlimix/messagebus-async-middleware.svg)](https://packagist.org/packages/qlimix/messagebus-async-middleware)
[![MIT License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/qlimix/messagebus-async-middleware/blob/master/LICENSE)

Asynchronous handling of message via messagebus middleware.

## Install

Using Composer:

~~~
$ composer require qlimix/messagebus-async-middleware
~~~

## usage
```php
<?php

use Qlimix\MessageBus\MessageBus\Middleware\AsynchronousMiddleware;

$producer = new FooBarProducer();

$asyncMiddleware = new AsynchronousMiddleware($producer, 'foobar');
```

## Testing
To run all unit tests locally with PHPUnit:

~~~
$ vendor/bin/phpunit
~~~

## Quality
To ensure code quality run grumphp which will run all tools:

~~~
$ vendor/bin/grumphp run
~~~

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
