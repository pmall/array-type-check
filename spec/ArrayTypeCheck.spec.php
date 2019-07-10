<?php

use function Eloquent\Phony\Kahlan\mock;

use Quanta\ArrayTypeCheck;
use Quanta\ArrayTypeCheck\{
    Success,
    Failure,
    CustomType,
    BuiltInType,
    CallableType,
    TypeInterface,
};

require_once __DIR__ . '/.test/classes.php';

describe('ArrayTypeCheck::type()', function () {

    context('when the given type is callable', function () {

        it('should return an ArrayTypeCheck with a CallableType', function () {

            $test = ArrayTypeCheck::type('callable');

            expect($test)->toEqual(new ArrayTypeCheck(
                new CallableType
            ));

        });

    });

    context('when the given type is built in', function () {

        it('should return an ArrayTypeCheck with a BuiltInType', function () {

            $test = function (string $type) {
                return ArrayTypeCheck::type($type);
            };

            $expected = function (string $type) {
                return new ArrayTypeCheck(new BuiltInType($type));
            };

            expect($test('bool'))->toEqual($expected('bool'));
            expect($test('boolean'))->toEqual($expected('boolean'));
            expect($test('int'))->toEqual($expected('int'));
            expect($test('integer'))->toEqual($expected('integer'));
            expect($test('float'))->toEqual($expected('float'));
            expect($test('double'))->toEqual($expected('double'));
            expect($test('string'))->toEqual($expected('string'));
            expect($test('array'))->toEqual($expected('array'));
            expect($test('object'))->toEqual($expected('object'));
            expect($test('resource'))->toEqual($expected('resource'));
            expect($test('null'))->toEqual($expected('null'));
            expect($test('NULL'))->toEqual($expected('NULL'));

        });

    });

    context('when the given type is an interface name', function () {

        it('should return an ArrayTypeCheck with a CustomType', function () {

            $test = ArrayTypeCheck::type(Test\SomeInterface::class);

            expect($test)->toEqual(new ArrayTypeCheck(
                new CustomType(Test\SomeInterface::class)
            ));

        });

    });

    context('when the given type is a class name', function () {

        it('should return an ArrayTypeCheck with a CustomType', function () {

            $test = ArrayTypeCheck::type(Test\SomeClass::class);

            expect($test)->toEqual(new ArrayTypeCheck(
                new CustomType(Test\SomeClass::class))
            );

        });

    });

    context('when the given type is invalid', function () {

        it('should throw an InvalidArgumentException', function () {

            $test = function () {
                ArrayTypeCheck::type('test');
            };

            expect($test)->toThrow(new InvalidArgumentException);

        });

    });

});

describe('ArrayTypeCheck', function () {

    beforeEach(function () {

        $this->type = mock(TypeInterface::class);

        $this->check = new ArrayTypeCheck($this->type->get());

    });

    describe('->on()', function () {

        context('when the given array values are all typed as expected', function () {

            it('should return a success', function () {

                $this->type->isAccepting->with('value1')->returns(true);
                $this->type->isAccepting->with('value2')->returns(true);
                $this->type->isAccepting->with('value3')->returns(true);

                $test = $this->check->on([
                    'k1' => 'value1',
                    'k2' => 'value2',
                    'k3' => 'value3',
                ]);

                expect($test)->toEqual(new Success);

            });

        });

        context('when the given array values are all typed as expected', function () {

            it('should return a failure', function () {

                $this->type->isAccepting->with('value1')->returns(true);
                $this->type->isAccepting->with('value2')->returns(false);
                $this->type->isAccepting->with('value3')->returns(true);

                $test = $this->check->on([
                    'k1' => 'value1',
                    'k2' => 'value2',
                    'k3' => 'value3',
                ]);

                expect($test)->toEqual(new Failure($this->type->get(), 'k2', 'value2'));

            });

        });

    });

});
