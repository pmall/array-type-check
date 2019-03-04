<?php

use function Eloquent\Phony\Kahlan\mock;

use Quanta\ArrayTypeCheck\ResultInterface;
use Quanta\ArrayTypeCheck\InvalidArrayMessage;

require_once __DIR__ . '/../.test/classes.php';

describe('InvalidArrayMessage', function () {

    beforeEach(function () {

        $this->result = mock(ResultInterface::class);

        $this->result->given->returns('value');
        $this->result->expected->returns('expected');

        $this->message = new InvalidArrayMessage($this->result->get());

    });

    describe('->source()', function () {

        context('when the result ->path() method returns one key', function () {

            it('should return an invalid array message', function () {

                $this->result->path->returns(['test']);

                $test = $this->message->source('source');

                expect($test)->toEqual('Source must be expected, value given for key [test]');

            });

        });

        context('when the result ->path() method returns more than one key', function () {

            it('should return a nested invalid array message', function () {

                $this->result->path->returns(['test1', 'test2', 'test3']);

                $test = $this->message->source('source');

                expect($test)->toEqual('Key [test1][test2] of source must be expected, value given for key [test3]');

            });

        });

    });

    describe('->function()', function () {

        context('when the result ->path() method returns one key', function () {

            it('should return an invalid argument exception for a function call', function () {

                $this->result->path->returns(['test']);

                $test = $this->message->function('function', 1);

                expect($test)->toEqual('Argument 1 passed to function() must be expected, value given for key [test]');

            });

        });

        context('when the result ->path() method returns more than one key', function () {

            it('should return an invalid argument exception for a function call', function () {

                $this->result->path->returns(['test1', 'test2', 'test3']);

                $test = $this->message->function('function', 1);

                expect($test)->toEqual('Key [test1][test2] of argument 1 passed to function() must be expected, value given for key [test3]');

            });

        });

    });

    describe('->closure()', function () {

        context('when the result ->path() method returns one key', function () {

            it('should return an invalid argument exception for a closure call', function () {

                $this->result->path->returns(['test']);

                $test = $this->message->closure(1);

                expect($test)->toEqual('Argument 1 passed to {closure}() must be expected, value given for key [test]');

            });

        });

        context('when the result ->path() method returns more than one key', function () {

            it('should return an invalid argument exception for a closure call', function () {

                $this->result->path->returns(['test1', 'test2', 'test3']);

                $test = $this->message->closure(1);

                expect($test)->toEqual('Key [test1][test2] of argument 1 passed to {closure}() must be expected, value given for key [test3]');

            });

        });

    });

    describe('->static()', function () {

        context('when the result ->path() method returns one key', function () {

            it('should return an invalid argument exception for a closure call', function () {

                $this->result->path->returns(['test']);

                $test = $this->message->static(Test\TestClass::class, 'method', 1);

                expect($test)->toEqual('Argument 1 passed to Test\TestClass::method() must be expected, value given for key [test]');

            });

        });

        context('when the result ->path() method returns more than one key', function () {

            it('should return an invalid argument exception for a closure call', function () {

                $this->result->path->returns(['test1', 'test2', 'test3']);

                $test = $this->message->static(Test\TestClass::class, 'method', 1);

                expect($test)->toEqual('Key [test1][test2] of argument 1 passed to Test\TestClass::method() must be expected, value given for key [test3]');

            });

        });

    });

    describe('->method()', function () {

        context('when the given object is anonymous', function () {

            context('when the result ->path() method returns one key', function () {

                it('should return an invalid argument exception for a closure call', function () {

                    $this->result->path->returns(['test']);

                    $test = $this->message->method(new class {}, 'method', 1);

                    expect($test)->toEqual('Argument 1 passed to class@anonymous::method() must be expected, value given for key [test]');

                });

            });

            context('when the result ->path() method returns more than one key', function () {

                it('should return an invalid argument exception for a closure call', function () {

                    $this->result->path->returns(['test1', 'test2', 'test3']);

                    $test = $this->message->method(new class {}, 'method', 1);

                    expect($test)->toEqual('Key [test1][test2] of argument 1 passed to class@anonymous::method() must be expected, value given for key [test3]');

                });

            });

        });

        context('when the given object is not anonymous', function () {

            context('when the result ->path() method returns one key', function () {

                it('should return an invalid argument exception for a closure call', function () {

                    $this->result->path->returns(['test']);

                    $test = $this->message->method(new Test\TestClass, 'method', 1);

                    expect($test)->toEqual('Argument 1 passed to Test\TestClass::method() must be expected, value given for key [test]');

                });

            });

            context('when the result ->path() method returns more than one key', function () {

                it('should return an invalid argument exception for a closure call', function () {

                    $this->result->path->returns(['test1', 'test2', 'test3']);

                    $test = $this->message->method(new Test\TestClass, 'method', 1);

                    expect($test)->toEqual('Key [test1][test2] of argument 1 passed to Test\TestClass::method() must be expected, value given for key [test3]');

                });

            });

        });

    });

    describe('->constructor()', function () {

        context('when the given object is anonymous', function () {

            context('when the result ->path() method returns one key', function () {

                it('should return an invalid argument exception for a closure call', function () {

                    $this->result->path->returns(['test']);

                    $test = $this->message->constructor(new class {}, 1);

                    expect($test)->toEqual('Argument 1 passed to class@anonymous::__construct() must be expected, value given for key [test]');

                });

            });

            context('when the result ->path() method returns more than one key', function () {

                it('should return an invalid argument exception for a closure call', function () {

                    $this->result->path->returns(['test1', 'test2', 'test3']);

                    $test = $this->message->constructor(new class {}, 1);

                    expect($test)->toEqual('Key [test1][test2] of argument 1 passed to class@anonymous::__construct() must be expected, value given for key [test3]');

                });

            });

        });

        context('when the given object is not anonymous', function () {

            context('when the result ->path() method returns one key', function () {

                it('should return an invalid argument exception for a closure call', function () {

                    $this->result->path->returns(['test']);

                    $test = $this->message->constructor(new Test\TestClass, 1);

                    expect($test)->toEqual('Argument 1 passed to Test\TestClass::__construct() must be expected, value given for key [test]');

                });

            });

            context('when the result ->path() method returns more than one key', function () {

                it('should return an invalid argument exception for a closure call', function () {

                    $this->result->path->returns(['test1', 'test2', 'test3']);

                    $test = $this->message->constructor(new Test\TestClass, 1);

                    expect($test)->toEqual('Key [test1][test2] of argument 1 passed to Test\TestClass::__construct() must be expected, value given for key [test3]');

                });

            });

        });

    });

});
