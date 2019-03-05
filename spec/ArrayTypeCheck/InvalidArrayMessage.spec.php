<?php

use function Eloquent\Phony\Kahlan\mock;

use Quanta\ArrayTypeCheck\ResultInterface;
use Quanta\ArrayTypeCheck\InvalidArrayMessage;
use Quanta\ArrayTypeCheck\FailureFormatterInterface;

require_once __DIR__ . '/../.test/classes.php';

describe('InvalidArrayMessage', function () {

    beforeEach(function () {

        $this->formatter = mock(FailureFormatterInterface::class);

        $this->message = new InvalidArrayMessage($this->formatter->get());

    });

    describe('->source()', function () {

        it('should format the result with the given source', function () {

            $this->formatter->__invoke->with('source')->returns('value');

            $test = $this->message->source('source');

            expect($test)->toEqual('value');

        });

    });

    describe('->function()', function () {

        it('should format the result for a function call', function () {

            $this->formatter->__invoke->with('argument 1 passed to function()')->returns('value');

            $test = $this->message->function('function', 1);

            expect($test)->toEqual('value');

        });

    });

    describe('->closure()', function () {

        it('should format the result for a closure call', function () {

            $this->formatter->__invoke->with('argument 1 passed to {closure}()')->returns('value');

            $test = $this->message->closure(1);

            expect($test)->toEqual('value');

        });

    });

    describe('->static()', function () {

        it('should format the result for a static method call', function () {

            $this->formatter->__invoke
                ->with(sprintf('argument 1 passed to %s::%s()', Test\TestClass::class, 'method'))
                ->returns('value');

            $test = $this->message->method(new Test\TestClass, 'method', 1);

            expect($test)->toEqual('value');

        });

    });

    describe('->method()', function () {

        context('when the given object is anonymous', function () {

            it('should format the result for an anonymous object method call', function () {

                $this->formatter->__invoke
                    ->with('argument 1 passed to class@anonymous::method()')
                    ->returns('value');

                $test = $this->message->method(new class {}, 'method', 1);

                expect($test)->toEqual('value');

            });

        });

        context('when the given object is not anonymous', function () {

            it('should format the result for an object method call', function () {

                $this->formatter->__invoke
                    ->with(sprintf('argument 1 passed to %s::method()', Test\TestClass::class))
                    ->returns('value');

                $test = $this->message->method(new Test\TestClass, 'method', 1);

                expect($test)->toEqual('value');

            });

        });

    });

    describe('->constructor()', function () {

        context('when the given object is anonymous', function () {

            it('should format the result for an anonymous object constructor call', function () {

                $this->formatter->__invoke
                    ->with('argument 1 passed to class@anonymous::__construct()')
                    ->returns('value');

                $test = $this->message->constructor(new class {}, 1);

                expect($test)->toEqual('value');

            });

        });

        context('when the given object is not anonymous', function () {

            it('should format the result for an object constructor call', function () {

                $this->formatter->__invoke
                    ->with(sprintf('argument 1 passed to %s::__construct()', Test\TestClass::class))
                    ->returns('value');

                $test = $this->message->constructor(new Test\TestClass, 1);

                expect($test)->toEqual('value');

            });

        });

    });

});
