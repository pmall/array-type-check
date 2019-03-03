<?php

use Quanta\ArrayTypeCheck\Type;
use Quanta\ArrayTypeCheck\TypeInterface;

require_once __DIR__ . '/../.test/classes.php';

describe('Type', function () {

    context('when the type is boolean', function () {

        beforeEach(function () {

            $this->type = new Type('boolean');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->str()', function () {

            it('should return boolean', function () {

                $test = $this->type->str();

                expect($test)->toEqual('boolean');

            });

        });

        describe('->isValid()', function () {

            context('when the given value is a boolean', function () {

                it('should return true', function () {

                    $test = $this->type->isValid(true);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not a boolean', function () {

                it('should return false', function () {

                    $test = $this->type->isValid(1);

                    expect($test)->toBeFalsy();

                });

            });

        });

    });

    context('when the type is integer', function () {

        beforeEach(function () {

            $this->type = new Type('integer');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->str()', function () {

            it('should return integer', function () {

                $test = $this->type->str();

                expect($test)->toEqual('integer');

            });

        });

        describe('->isValid()', function () {

            context('when the given value is an integer', function () {

                it('should return true', function () {

                    $test = $this->type->isValid(1);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not an integer', function () {

                it('should return false', function () {

                    $test = $this->type->isValid(true);

                    expect($test)->toBeFalsy();

                });

            });

        });

    });

    context('when the type is double', function () {

        beforeEach(function () {

            $this->type = new Type('double');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->str()', function () {

            it('should return double', function () {

                $test = $this->type->str();

                expect($test)->toEqual('double');

            });

        });

        describe('->isValid()', function () {

            context('when the given value is a float', function () {

                it('should return true', function () {

                    $test = $this->type->isValid(1.1);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not a float', function () {

                it('should return false', function () {

                    $test = $this->type->isValid(1);

                    expect($test)->toBeFalsy();

                });

            });

        });

    });

    context('when the type is string', function () {

        beforeEach(function () {

            $this->type = new Type('string');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->str()', function () {

            it('should return string', function () {

                $test = $this->type->str();

                expect($test)->toEqual('string');

            });

        });

        describe('->isValid()', function () {

            context('when the given value is a string', function () {

                it('should return true', function () {

                    $test = $this->type->isValid('value');

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not a string', function () {

                it('should return false', function () {

                    $test = $this->type->isValid(1);

                    expect($test)->toBeFalsy();

                });

            });

        });

    });

    context('when the type is array', function () {

        beforeEach(function () {

            $this->type = new Type('array');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->str()', function () {

            it('should return array', function () {

                $test = $this->type->str();

                expect($test)->toEqual('array');

            });

        });

        describe('->isValid()', function () {

            context('when the given value is an array', function () {

                it('should return true', function () {

                    $test = $this->type->isValid([]);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not an array', function () {

                it('should return false', function () {

                    $test = $this->type->isValid(1);

                    expect($test)->toBeFalsy();

                });

            });

        });

    });

    context('when the type is object', function () {

        beforeEach(function () {

            $this->type = new Type('object');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->str()', function () {

            it('should return object', function () {

                $test = $this->type->str();

                expect($test)->toEqual('object');

            });

        });

        describe('->isValid()', function () {

            context('when the given value is an object', function () {

                it('should return true', function () {

                    $test = $this->type->isValid(new class {});

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not an object', function () {

                it('should return false', function () {

                    $test = $this->type->isValid(1);

                    expect($test)->toBeFalsy();

                });

            });

        });

    });

    context('when the type is resource', function () {

        beforeEach(function () {

            $this->type = new Type('resource');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->str()', function () {

            it('should return resource', function () {

                $test = $this->type->str();

                expect($test)->toEqual('resource');

            });

        });

        describe('->isValid()', function () {

            context('when the given value is a resource', function () {

                it('should return true', function () {

                    $test = $this->type->isValid(tmpfile());

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not a boolean', function () {

                it('should return false', function () {

                    $test = $this->type->isValid(1);

                    expect($test)->toBeFalsy();

                });

            });

        });

    });

    context('when the type is callable', function () {

        beforeEach(function () {

            $this->type = new Type('callable');

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->str()', function () {

            it('should return callable', function () {

                $test = $this->type->str();

                expect($test)->toEqual('callable');

            });

        });

        describe('->isValid()', function () {

            context('when the given value is a callable', function () {

                it('should return true', function () {

                    $test = $this->type->isValid(function () {});

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not a callable', function () {

                it('should return false', function () {

                    $test = $this->type->isValid(1);

                    expect($test)->toBeFalsy();

                });

            });

        });

    });

    context('when the type is an interface name', function () {

        beforeEach(function () {

            $this->type = new Type(Test\TestInterface::class);

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->str()', function () {

            it('should return the interface name', function () {

                $test = $this->type->str();

                expect($test)->toEqual(Test\TestInterface::class);

            });

        });

        describe('->isValid()', function () {

            context('when the given value is an implementation of the interface', function () {

                it('should return true', function () {

                    $test = $this->type->isValid(new class implements Test\TestInterface {});

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not an implementation of the interface', function () {

                it('should return false', function () {

                    $test = $this->type->isValid(1);

                    expect($test)->toBeFalsy();

                });

            });

        });

    });

    context('when the type is a class name', function () {

        beforeEach(function () {

            $this->type = new Type(Test\TestClass::class);

        });

        it('should implement TypeInterface', function () {

            expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

        });

        describe('->str()', function () {

            it('should return the class name', function () {

                $test = $this->type->str();

                expect($test)->toEqual(Test\TestClass::class);

            });

        });

        describe('->isValid()', function () {

            context('when the given value is an instance of the class', function () {

                it('should return true', function () {

                    $test = $this->type->isValid(new Test\TestClass);

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not an instance of the class', function () {

                it('should return false', function () {

                    $test = $this->type->isValid(1);

                    expect($test)->toBeFalsy();

                });

            });

        });

    });

});
