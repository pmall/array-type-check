<?php

use Quanta\ArrayTypeCheck\{
    CustomType,
    TypeInterface,
};

require_once __DIR__ . '/../.test/classes.php';

describe('CustomType', function () {

    context('when the custom type is an interface name', function () {

        beforeEach(function () {

            $this->type = new CustomType(Test\SomeInterface::class);

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->isAccepting()', function () {

            context('when the given value is an implementation of the interface', function () {

                it('should be truthy', function () {

                    $test = $this->type->isAccepting(new class implements Test\SomeInterface {});

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not an implementation of the interface', function () {

                it('should be falsy', function () {

                    $test = $this->type->isAccepting(new class {});

                    expect($test)->toBeFalsy();

                });

            });

        });

        describe('->message()', function () {

            it('should return an error message for any given value', function () {

                $test = function ($value) {
                    return $this->type->message('source', 'key', $value);
                };

                $expected = function (string $given) {
                    return sprintf('source must be an array of Test\SomeInterface implementations, %s given for key [key]', $given);
                };

                expect($test(true))->toEqual($expected('boolean'));
                expect($test(1))->toEqual($expected('integer'));
                expect($test(1.1))->toEqual($expected('float'));
                expect($test('test'))->toEqual($expected('string'));
                expect($test([]))->toEqual($expected('array'));
                expect($test(new class {}))->toEqual($expected('instance of class@anonymous'));
                expect($test(new Test\SomeClass))->toEqual($expected('instance of Test\SomeClass'));
                expect($test(tmpfile()))->toEqual($expected('resource'));
                expect($test(null))->toEqual($expected('null'));

            });

        });

    });

    context('when the custom type is a class name', function () {

        beforeEach(function () {

            $this->type = new CustomType(Test\SomeClass::class);

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->isAccepting()', function () {

            context('when the given value is an instance of the class', function () {

                it('should be truthy', function () {

                    $test = $this->type->isAccepting(new Test\SomeClass);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not an instance of the class', function () {

                it('should be falsy', function () {

                    $test = $this->type->isAccepting(1);

                    expect($test)->toBeFalsy();

                });

            });

        });

        describe('->message()', function () {

            it('should return an error message for any given value', function () {

                $test = function ($value) {
                    return $this->type->message('source', 'key', $value);
                };

                $expected = function (string $given) {
                    return sprintf('source must be an array of Test\SomeClass instances, %s given for key [key]', $given);
                };

                expect($test(true))->toEqual($expected('boolean'));
                expect($test(1))->toEqual($expected('integer'));
                expect($test(1.1))->toEqual($expected('float'));
                expect($test('test'))->toEqual($expected('string'));
                expect($test([]))->toEqual($expected('array'));
                expect($test(new class {}))->toEqual($expected('instance of class@anonymous'));
                expect($test(new Test\SomeClass))->toEqual($expected('instance of Test\SomeClass'));
                expect($test(tmpfile()))->toEqual($expected('resource'));
                expect($test(null))->toEqual($expected('null'));

            });

        });

    });

    context('when the custom type is neither an interface name or a class name', function () {

        it('should throw an InvalidArgumentException', function () {

            $test = function () { new CustomType('test'); };

            expect($test)->toThrow(new InvalidArgumentException);

        });

    });

});
