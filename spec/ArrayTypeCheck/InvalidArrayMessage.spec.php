<?php

use function Eloquent\Phony\Kahlan\mock;

use Quanta\ArrayTypeCheck\ResultInterface;
use Quanta\ArrayTypeCheck\InvalidArrayMessage;

require_once __DIR__ . '/../.test/classes.php';

describe('InvalidArrayMessage::function()', function () {

    it('should return a message for a function call', function () {

        $result = mock(ResultInterface::class);

        $result->isValid->returns(false);
        $result->given->returns('value');
        $result->expected->returns('expected');
        $result->path->returns(['test']);

        $test = InvalidArrayMessage::function('function', 1, $result->get());

        expect($test)->toEqual('Argument 1 passed to function() must be expected, value given for key [test]');

    });

});

describe('InvalidArrayMessage::closure()', function () {

    it('should return a message for a closure call', function () {

        $result = mock(ResultInterface::class);

        $result->isValid->returns(false);
        $result->given->returns('value');
        $result->expected->returns('expected');
        $result->path->returns(['test']);

        $test = InvalidArrayMessage::closure(1, $result->get());

        expect($test)->toEqual('Argument 1 passed to {closure}() must be expected, value given for key [test]');

    });

});

describe('InvalidArrayMessage::static()', function () {

    it('should return a message for a static method call', function () {

        $result = mock(ResultInterface::class);

        $result->isValid->returns(false);
        $result->given->returns('value');
        $result->expected->returns('expected');
        $result->path->returns(['test']);

        $test = InvalidArrayMessage::static(
            Test\TestClass::class, 'method', 1, $result->get()
        );

        expect($test)->toEqual('Argument 1 passed to Test\TestClass::method() must be expected, value given for key [test]');

    });

});

describe('InvalidArrayMessage::method()', function () {

    beforeEach(function () {

        $this->result = mock(ResultInterface::class);

        $this->result->isValid->returns(false);
        $this->result->given->returns('value');
        $this->result->expected->returns('expected');
        $this->result->path->returns(['test']);

    });

    context('when the given object is anonymous', function () {

        it('should return a message for an instance method call', function () {

            $test = InvalidArrayMessage::method(
                new class {}, 'method', 1, $this->result->get()
            );

            expect($test)->toEqual('Argument 1 passed to class@anonymous::method() must be expected, value given for key [test]');

        });

    });

    context('when the given object is not anonymous', function () {

        it('should return a message for an instance method call', function () {

            $this->result->path->returns(['test']);

            $test = InvalidArrayMessage::method(
                new Test\TestClass, 'method', 1, $this->result->get()
            );

            expect($test)->toEqual('Argument 1 passed to Test\TestClass::method() must be expected, value given for key [test]');

        });

    });

});

describe('InvalidArrayMessage::constructor()', function () {

    beforeEach(function () {

        $this->result = mock(ResultInterface::class);

        $this->result->isValid->returns(false);
        $this->result->given->returns('value');
        $this->result->expected->returns('expected');
        $this->result->path->returns(['test']);

    });

    context('when the given object is anonymous', function () {

        it('should return a message for constructor call', function () {

            $test = InvalidArrayMessage::constructor(
                new class {}, 1, $this->result->get()
            );

            expect($test)->toEqual('Argument 1 passed to class@anonymous::__construct() must be expected, value given for key [test]');

        });

    });

    context('when the given object is not anonymous', function () {

        it('should return a message for constructor call', function () {

            $this->result->path->returns(['test']);

            $test = InvalidArrayMessage::constructor(
                new Test\TestClass, 1, $this->result->get()
            );

            expect($test)->toEqual('Argument 1 passed to Test\TestClass::__construct() must be expected, value given for key [test]');

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
