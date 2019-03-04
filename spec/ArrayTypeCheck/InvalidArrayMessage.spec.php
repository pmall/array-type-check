<?php

use function Eloquent\Phony\Kahlan\mock;

use Quanta\ArrayTypeCheck\ResultInterface;
use Quanta\ArrayTypeCheck\InvalidArrayMessage;

require_once __DIR__ . '/../.test/classes.php';

describe('InvalidArrayMessage::function()', function () {

    beforeEach(function () {

        $this->result = mock(ResultInterface::class);

        $this->result->isValid->returns(false);
        $this->result->given->returns('value');
        $this->result->expected->returns('expected');

    });

    context('when the result ->path() method returns one key', function () {

        it('should return a message for the given function name and argument position', function () {

            $this->result->path->returns(['test']);

            $test = InvalidArrayMessage::function('function', 1, $this->result->get());

            expect($test)->toEqual('Argument 1 passed to function() must be expected, value given for key [test]');

        });

    });

    context('when the result ->path() method returns more than one key', function () {

        it('should return a message for the given function name and argument position', function () {

            $this->result->path->returns(['test1', 'test2', 'test3']);

            $test = InvalidArrayMessage::function('function', 1, $this->result->get());

            expect($test)->toEqual('Key [test1][test2] of argument 1 passed to function() must be expected, value given for key [test3]');

        });

    });

});

describe('InvalidArrayMessage::closure()', function () {

    beforeEach(function () {

        $this->result = mock(ResultInterface::class);

        $this->result->given->returns('value');
        $this->result->expected->returns('expected');

    });

    context('when the result ->path() method returns one key', function () {

        it('should return a message for a closure and the given argument position', function () {

            $this->result->path->returns(['test']);

            $test = InvalidArrayMessage::closure(1, $this->result->get());

            expect($test)->toEqual('Argument 1 passed to {closure}() must be expected, value given for key [test]');

        });

    });

    context('when the result ->path() method returns more than one key', function () {

        it('should return a message for a closure and the given argument position', function () {

            $this->result->path->returns(['test1', 'test2', 'test3']);

            $test = InvalidArrayMessage::closure(1, $this->result->get());

            expect($test)->toEqual('Key [test1][test2] of argument 1 passed to {closure}() must be expected, value given for key [test3]');

        });

    });

});

describe('InvalidArrayMessage::method()', function () {

    beforeEach(function () {

        $this->result = mock(ResultInterface::class);

        $this->result->given->returns('value');
        $this->result->expected->returns('expected');

    });

    context('when the given class name is a string', function () {

        context('when the result ->path() method returns one key', function () {

            it('should return a message for the given object method and argument position', function () {

                $this->result->path->returns(['test']);

                $test = InvalidArrayMessage::method(
                    Test\TestClass::class,
                    'method',
                    1,
                    $this->result->get()
                );

                expect($test)->toEqual('Argument 1 passed to Test\TestClass::method() must be expected, value given for key [test]');

            });

        });

        context('when the result ->path() method returns more than one key', function () {

            it('should return a message for the given object method and argument position', function () {

                $this->result->path->returns(['test1', 'test2', 'test3']);

                $test = InvalidArrayMessage::method(
                    Test\TestClass::class,
                    'method',
                    1,
                    $this->result->get()
                );

                expect($test)->toEqual('Key [test1][test2] of argument 1 passed to Test\TestClass::method() must be expected, value given for key [test3]');

            });

        });

    });

    context('when the given class name is an object', function () {

        context('when the given object is anonymous', function () {

            context('when the result ->path() method returns one key', function () {

                it('should return a message for the given object method and argument position', function () {

                    $this->result->path->returns(['test']);

                    $test = InvalidArrayMessage::method(
                        new class {},
                        'method',
                        1,
                        $this->result->get()
                    );

                    expect($test)->toEqual('Argument 1 passed to class@anonymous::method() must be expected, value given for key [test]');

                });

            });

            context('when the result ->path() method returns more than one key', function () {

                it('should return a message for the given object method and argument position', function () {

                    $this->result->path->returns(['test1', 'test2', 'test3']);

                    $test = InvalidArrayMessage::method(
                        new class {},
                        'method',
                        1,
                        $this->result->get()
                    );

                    expect($test)->toEqual('Key [test1][test2] of argument 1 passed to class@anonymous::method() must be expected, value given for key [test3]');

                });

            });

        });

        context('when the given object is not anonymous', function () {

            context('when the result ->path() method returns one key', function () {

                it('should return a message for the given object method and argument position', function () {

                    $this->result->path->returns(['test']);

                    $test = InvalidArrayMessage::method(
                        new Test\TestClass,
                        'method',
                        1,
                        $this->result->get()
                    );

                    expect($test)->toEqual('Argument 1 passed to Test\TestClass::method() must be expected, value given for key [test]');

                });

            });

            context('when the result ->path() method returns more than one key', function () {

                it('should return a message for the given object method and argument position', function () {

                    $this->result->path->returns(['test1', 'test2', 'test3']);

                    $test = InvalidArrayMessage::method(
                        new Test\TestClass,
                        'method',
                        1,
                        $this->result->get()
                    );

                    expect($test)->toEqual('Key [test1][test2] of argument 1 passed to Test\TestClass::method() must be expected, value given for key [test3]');

                });

            });

        });

    });

    context('when the given class name is not a string or an object', function () {

        it('should return throw an InvalidArgumentException', function () {

            $test = function () {
                InvalidArrayMessage::method([], 'method', 1, $this->result->get());
            };

            expect($test)->toThrow(new InvalidArgumentException);

        });

    });

});

describe('InvalidArrayMessage', function () {

    beforeEach(function () {

        $this->result = mock(ResultInterface::class);

    });

    context('when the result is a success', function () {

        it('should throw an InvalidArgumentException', function () {

            $this->result->isValid->returns(true);

            $test = function () {
                new InvalidArrayMessage('source', $this->result->get());
            };

            expect($test)->toThrow(new InvalidArgumentException);

        });

    });

    context('when the result is a failure', function () {

        beforeEach(function () {

            $this->result->isValid->returns(false);

            $this->message = new InvalidArrayMessage('source', $this->result->get());

        });

        describe('->__toString()', function () {

            beforeEach(function () {

                $this->result->given->returns('value');
                $this->result->expected->returns('expected');

            });

            context('when the result ->path() method returns one key', function () {

                it('should return an invalid array message', function () {

                    $this->result->path->returns(['test']);

                    $test = (string) $this->message;

                    expect($test)->toEqual('Source must be expected, value given for key [test]');

                });

            });

            context('when the result ->path() method returns more than one key', function () {

                it('should return a nested invalid array message', function () {

                    $this->result->path->returns(['test1', 'test2', 'test3']);

                    $test = (string) $this->message;

                    expect($test)->toEqual('Key [test1][test2] of source must be expected, value given for key [test3]');

                });

            });

        });

    });

});
