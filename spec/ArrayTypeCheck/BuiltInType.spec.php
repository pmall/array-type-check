<?php

use Quanta\ArrayTypeCheck\{
    BuiltInType,
    TypeInterface,
};

require_once __DIR__ . '/../.test/classes.php';

describe('BuiltInType', function () {

    context('when the built in type is bool', function () {

        beforeEach(function () {

            $this->type = new BuiltInType('bool');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->isAccepting()', function () {

            context('when the given value is a boolean', function () {

                it('should be truthy', function () {

                    $test = $this->type->isAccepting(true);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not a boolean', function () {

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
                    return sprintf('source must be an array of booleans, %s given for key [key]', $given);
                };

                expect($test(true))->toEqual($expected('boolean'));
                expect($test(1))->toEqual($expected('integer'));
                expect($test(1.1))->toEqual($expected('float'));
                expect($test('test'))->toEqual($expected('string'));
                expect($test([]))->toEqual($expected('array'));
                expect($test(new class {}))->toEqual($expected('object'));
                expect($test(tmpfile()))->toEqual($expected('resource'));
                expect($test(null))->toEqual($expected('null'));

            });

        });

    });

    context('when the built in type is boolean', function () {

        beforeEach(function () {

            $this->type = new BuiltInType('boolean');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->isAccepting()', function () {

            context('when the given value is a boolean', function () {

                it('should be truthy', function () {

                    $test = $this->type->isAccepting(true);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not a boolean', function () {

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
                    return sprintf('source must be an array of booleans, %s given for key [key]', $given);
                };

                expect($test(true))->toEqual($expected('boolean'));
                expect($test(1))->toEqual($expected('integer'));
                expect($test(1.1))->toEqual($expected('float'));
                expect($test('test'))->toEqual($expected('string'));
                expect($test([]))->toEqual($expected('array'));
                expect($test(new class {}))->toEqual($expected('object'));
                expect($test(tmpfile()))->toEqual($expected('resource'));
                expect($test(null))->toEqual($expected('null'));

            });

        });

    });

    context('when the built in type is int', function () {

        beforeEach(function () {

            $this->type = new BuiltInType('int');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->isAccepting()', function () {

            context('when the given value is an integer', function () {

                it('should be truthy', function () {

                    $test = $this->type->isAccepting(1);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not an integer', function () {

                it('should be falsy', function () {

                    $test = $this->type->isAccepting('1');

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
                    return sprintf('source must be an array of integers, %s given for key [key]', $given);
                };

                expect($test(true))->toEqual($expected('boolean'));
                expect($test(1))->toEqual($expected('integer'));
                expect($test(1.1))->toEqual($expected('float'));
                expect($test('test'))->toEqual($expected('string'));
                expect($test([]))->toEqual($expected('array'));
                expect($test(new class {}))->toEqual($expected('object'));
                expect($test(tmpfile()))->toEqual($expected('resource'));
                expect($test(null))->toEqual($expected('null'));

            });

        });

    });

    context('when the built in type is integer', function () {

        beforeEach(function () {

            $this->type = new BuiltInType('integer');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->isAccepting()', function () {

            context('when the given value is an integer', function () {

                it('should be truthy', function () {

                    $test = $this->type->isAccepting(1);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not an integer', function () {

                it('should be falsy', function () {

                    $test = $this->type->isAccepting('1');

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
                    return sprintf('source must be an array of integers, %s given for key [key]', $given);
                };

                expect($test(true))->toEqual($expected('boolean'));
                expect($test(1))->toEqual($expected('integer'));
                expect($test(1.1))->toEqual($expected('float'));
                expect($test('test'))->toEqual($expected('string'));
                expect($test([]))->toEqual($expected('array'));
                expect($test(new class {}))->toEqual($expected('object'));
                expect($test(tmpfile()))->toEqual($expected('resource'));
                expect($test(null))->toEqual($expected('null'));

            });

        });

    });

    context('when the built in type is float', function () {

        beforeEach(function () {

            $this->type = new BuiltInType('float');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->isAccepting()', function () {

            context('when the given value is a float', function () {

                it('should be truthy', function () {

                    $test = $this->type->isAccepting(1.1);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not a float', function () {

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
                    return sprintf('source must be an array of floats, %s given for key [key]', $given);
                };

                expect($test(true))->toEqual($expected('boolean'));
                expect($test(1))->toEqual($expected('integer'));
                expect($test(1.1))->toEqual($expected('float'));
                expect($test('test'))->toEqual($expected('string'));
                expect($test([]))->toEqual($expected('array'));
                expect($test(new class {}))->toEqual($expected('object'));
                expect($test(tmpfile()))->toEqual($expected('resource'));
                expect($test(null))->toEqual($expected('null'));

            });

        });

    });

    context('when the built in type is double', function () {

        beforeEach(function () {

            $this->type = new BuiltInType('double');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->isAccepting()', function () {

            context('when the given value is a float', function () {

                it('should be truthy', function () {

                    $test = $this->type->isAccepting(1.1);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not a float', function () {

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
                    return sprintf('source must be an array of floats, %s given for key [key]', $given);
                };

                expect($test(true))->toEqual($expected('boolean'));
                expect($test(1))->toEqual($expected('integer'));
                expect($test(1.1))->toEqual($expected('float'));
                expect($test('test'))->toEqual($expected('string'));
                expect($test([]))->toEqual($expected('array'));
                expect($test(new class {}))->toEqual($expected('object'));
                expect($test(tmpfile()))->toEqual($expected('resource'));
                expect($test(null))->toEqual($expected('null'));

            });

        });

    });

    context('when the built in type is string', function () {

        beforeEach(function () {

            $this->type = new BuiltInType('string');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->isAccepting()', function () {

            context('when the given value is a string', function () {

                it('should be truthy', function () {

                    $test = $this->type->isAccepting('test');

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not a string', function () {

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
                    return sprintf('source must be an array of strings, %s given for key [key]', $given);
                };

                expect($test(true))->toEqual($expected('boolean'));
                expect($test(1))->toEqual($expected('integer'));
                expect($test(1.1))->toEqual($expected('float'));
                expect($test('test'))->toEqual($expected('string'));
                expect($test([]))->toEqual($expected('array'));
                expect($test(new class {}))->toEqual($expected('object'));
                expect($test(tmpfile()))->toEqual($expected('resource'));
                expect($test(null))->toEqual($expected('null'));

            });

        });

    });

    context('when the built in type is array', function () {

        beforeEach(function () {

            $this->type = new BuiltInType('array');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->isAccepting()', function () {

            context('when the given value is an array', function () {

                it('should be truthy', function () {

                    $test = $this->type->isAccepting([]);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not an array', function () {

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
                    return sprintf('source must be an array of arrays, %s given for key [key]', $given);
                };

                expect($test(true))->toEqual($expected('boolean'));
                expect($test(1))->toEqual($expected('integer'));
                expect($test(1.1))->toEqual($expected('float'));
                expect($test('test'))->toEqual($expected('string'));
                expect($test([]))->toEqual($expected('array'));
                expect($test(new class {}))->toEqual($expected('object'));
                expect($test(tmpfile()))->toEqual($expected('resource'));
                expect($test(null))->toEqual($expected('null'));

            });

        });

    });

    context('when the built in type is object', function () {

        beforeEach(function () {

            $this->type = new BuiltInType('object');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->isAccepting()', function () {

            context('when the given value is an object', function () {

                it('should be truthy', function () {

                    $test = $this->type->isAccepting(new class {});

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not an object', function () {

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
                    return sprintf('source must be an array of objects, %s given for key [key]', $given);
                };

                expect($test(true))->toEqual($expected('boolean'));
                expect($test(1))->toEqual($expected('integer'));
                expect($test(1.1))->toEqual($expected('float'));
                expect($test('test'))->toEqual($expected('string'));
                expect($test([]))->toEqual($expected('array'));
                expect($test(new class {}))->toEqual($expected('object'));
                expect($test(tmpfile()))->toEqual($expected('resource'));
                expect($test(null))->toEqual($expected('null'));

            });

        });

    });

    context('when the built in type is resource', function () {

        beforeEach(function () {

            $this->type = new BuiltInType('resource');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->isAccepting()', function () {

            context('when the given value is a resource', function () {

                it('should be truthy', function () {

                    $test = $this->type->isAccepting(tmpfile());

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not a resource', function () {

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
                    return sprintf('source must be an array of resources, %s given for key [key]', $given);
                };

                expect($test(true))->toEqual($expected('boolean'));
                expect($test(1))->toEqual($expected('integer'));
                expect($test(1.1))->toEqual($expected('float'));
                expect($test('test'))->toEqual($expected('string'));
                expect($test([]))->toEqual($expected('array'));
                expect($test(new class {}))->toEqual($expected('object'));
                expect($test(tmpfile()))->toEqual($expected('resource'));
                expect($test(null))->toEqual($expected('null'));

            });

        });

    });

    context('when the built in type is null', function () {

        beforeEach(function () {

            $this->type = new BuiltInType('null');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->isAccepting()', function () {

            context('when the given value is null', function () {

                it('should be truthy', function () {

                    $test = $this->type->isAccepting(null);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not null', function () {

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
                    return sprintf('source must be an array of null values, %s given for key [key]', $given);
                };

                expect($test(true))->toEqual($expected('boolean'));
                expect($test(1))->toEqual($expected('integer'));
                expect($test(1.1))->toEqual($expected('float'));
                expect($test('test'))->toEqual($expected('string'));
                expect($test([]))->toEqual($expected('array'));
                expect($test(new class {}))->toEqual($expected('object'));
                expect($test(tmpfile()))->toEqual($expected('resource'));
                expect($test(null))->toEqual($expected('null'));

            });

        });

    });

    context('when the built in type is NULL', function () {

        beforeEach(function () {

            $this->type = new BuiltInType('NULL');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->isAccepting()', function () {

            context('when the given value is null', function () {

                it('should be truthy', function () {

                    $test = $this->type->isAccepting(null);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not null', function () {

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
                    return sprintf('source must be an array of null values, %s given for key [key]', $given);
                };

                expect($test(true))->toEqual($expected('boolean'));
                expect($test(1))->toEqual($expected('integer'));
                expect($test(1.1))->toEqual($expected('float'));
                expect($test('test'))->toEqual($expected('string'));
                expect($test([]))->toEqual($expected('array'));
                expect($test(new class {}))->toEqual($expected('object'));
                expect($test(tmpfile()))->toEqual($expected('resource'));
                expect($test(null))->toEqual($expected('null'));

            });

        });

    });

    context('when the built in type is invalid', function () {

        it('should throw an InvalidArgumentException', function () {

            $test = function () { new BuiltInType('test'); };

            expect($test)->toThrow(new InvalidArgumentException);

        });

    });

});
