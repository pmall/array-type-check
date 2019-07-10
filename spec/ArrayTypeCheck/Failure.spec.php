<?php

use function Eloquent\Phony\Kahlan\mock;

use Quanta\ArrayTypeCheck\{
    Failure,
    TypeInterface,
    ResultInterface,
};

require_once __DIR__ . '/../.test/classes.php';

describe('Failure', function () {

    beforeEach(function () {

        $this->type = mock(TypeInterface::class);

        $this->result = new Failure($this->type->get(), 'key', 'value');

    });

    it('should implement ResultInterface', function () {

        expect($this->result)->toBeAnInstanceOf(ResultInterface::class);

    });

    describe('->isValid()', function () {

        it('should be falsy', function () {

            $test = $this->result->isValid();

            expect($test)->toBeFalsy();

        });

    });

    describe('->message()', function () {

        it('should proxy the type ->message() method', function () {

            $this->type->message
                ->with('source', 'key', 'value')
                ->returns('message');

            $test = $this->result->message('source');

            expect($test)->toEqual('message');

        });

    });

    describe('->function()', function () {

        it('should proxy the type ->message() method', function () {

            $this->type->message
                ->with('Argument 2 passed to test()', 'key', 'value')
                ->returns('message');

            $test = $this->result->function('test', 2);

            expect($test)->toEqual('message');

        });

    });

    describe('->static()', function () {

        it('should proxy the type ->message() method', function () {

            $this->type->message
                ->with('Argument 2 passed to Test\SomeClass::test()', 'key', 'value')
                ->returns('message');

            $test = $this->result->static(Test\SomeClass::class, 'test', 2);

            expect($test)->toEqual('message');

        });

    });

    describe('->method()', function () {

        context('when the object is anonymous', function () {

            it('should proxy the type ->message() method', function () {

                $this->type->message
                    ->with('Argument 2 passed to class@anonymous::test()', 'key', 'value')
                    ->returns('message');

                $test = $this->result->method(new class {}, 'test', 2);

                expect($test)->toEqual('message');

            });

        });

        context('when the object is not anonymous', function () {

            it('should proxy the type ->message() method', function () {

                $this->type->message
                    ->with('Argument 2 passed to Test\SomeClass::test()', 'key', 'value')
                    ->returns('message');

                $test = $this->result->method(new Test\SomeClass, 'test', 2);

                expect($test)->toEqual('message');

            });

        });

    });

    describe('->constructor()', function () {

        context('when the object is anonymous', function () {

            it('should proxy the type ->message() method', function () {

                $this->type->message
                    ->with('Argument 2 passed to class@anonymous::__construct()', 'key', 'value')
                    ->returns('message');

                $test = $this->result->constructor(new class {}, 2);

                expect($test)->toEqual('message');

            });

        });

        context('when the object is not anonymous', function () {

            it('should proxy the type ->message() method', function () {

                $this->type->message
                    ->with('Argument 2 passed to Test\SomeClass::__construct()', 'key', 'value')
                    ->returns('message');

                $test = $this->result->constructor(new Test\SomeClass, 2);

                expect($test)->toEqual('message');

            });

        });

    });

    describe('->closure()', function () {

        it('should proxy the type ->message() method', function () {

            $this->type->message
                ->with('Argument 2 passed to {closure}()', 'key', 'value')
                ->returns('message');

            $test = $this->result->closure(2);

            expect($test)->toEqual('message');

        });

    });

});
