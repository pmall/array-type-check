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

                expect($test)->toEqual('an array of booleans');

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

        describe('->formatted()', function () {

            context('when the given value is an object', function () {

                it('should return object', function () {

                    $test = $this->type->formatted(new class {});

                    expect($test)->toEqual('object');

                });

            });

            context('when the given value is not an object', function () {

                it('should return the result of gettype()', function () {

                    $test = $this->type->formatted(1);

                    expect($test)->toEqual('integer');

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

                expect($test)->toEqual('an array of integers');

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

        describe('->formatted()', function () {

            context('when the given value is an object', function () {

                it('should return object', function () {

                    $test = $this->type->formatted(new class {});

                    expect($test)->toEqual('object');

                });

            });

            context('when the given value is not an object', function () {

                it('should return the result of gettype()', function () {

                    $test = $this->type->formatted(1);

                    expect($test)->toEqual('integer');

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

                expect($test)->toEqual('an array of floats');

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

        describe('->formatted()', function () {

            context('when the given value is an object', function () {

                it('should return object', function () {

                    $test = $this->type->formatted(new class {});

                    expect($test)->toEqual('object');

                });

            });

            context('when the given value is not an object', function () {

                it('should return the result of gettype()', function () {

                    $test = $this->type->formatted(1);

                    expect($test)->toEqual('integer');

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

                expect($test)->toEqual('an array of strings');

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

        describe('->formatted()', function () {

            context('when the given value is an object', function () {

                it('should return object', function () {

                    $test = $this->type->formatted(new class {});

                    expect($test)->toEqual('object');

                });

            });

            context('when the given value is not an object', function () {

                it('should return the result of gettype()', function () {

                    $test = $this->type->formatted(1);

                    expect($test)->toEqual('integer');

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

                expect($test)->toEqual('an array of arrays');

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

        describe('->formatted()', function () {

            context('when the given value is an object', function () {

                it('should return object', function () {

                    $test = $this->type->formatted(new class {});

                    expect($test)->toEqual('object');

                });

            });

            context('when the given value is not an object', function () {

                it('should return the result of gettype()', function () {

                    $test = $this->type->formatted(1);

                    expect($test)->toEqual('integer');

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

                expect($test)->toEqual('an array of objects');

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

        describe('->formatted()', function () {

            context('when the given value is an object', function () {

                it('should return object', function () {

                    $test = $this->type->formatted(new class {});

                    expect($test)->toEqual('object');

                });

            });

            context('when the given value is not an object', function () {

                it('should return the result of gettype()', function () {

                    $test = $this->type->formatted(1);

                    expect($test)->toEqual('integer');

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

                expect($test)->toEqual('an array of resources');

            });

        });

        describe('->isValid()', function () {

            context('when the given value is a resource', function () {

                it('should return true', function () {

                    $test = $this->type->isValid(tmpfile());

                    expect($test)->toBeTruthy();

                });

            });

            context('when the given value is not a resource', function () {

                it('should return false', function () {

                    $test = $this->type->isValid(1);

                    expect($test)->toBeFalsy();

                });

            });

        });

        describe('->formatted()', function () {

            context('when the given value is an object', function () {

                it('should return object', function () {

                    $test = $this->type->formatted(new class {});

                    expect($test)->toEqual('object');

                });

            });

            context('when the given value is not an object', function () {

                it('should return the result of gettype()', function () {

                    $test = $this->type->formatted(1);

                    expect($test)->toEqual('integer');

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

                expect($test)->toEqual('an array of callables');

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

        describe('->formatted()', function () {

            context('when the given value is an object', function () {

                it('should return object', function () {

                    $test = $this->type->formatted(new class {});

                    expect($test)->toEqual('object');

                });

            });

            context('when the given value is not an object', function () {

                it('should return the result of gettype()', function () {

                    $test = $this->type->formatted(1);

                    expect($test)->toEqual('integer');

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

                expect($test)->toEqual(sprintf('an array of %s implementations', Test\TestInterface::class));

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

        describe('->formatted()', function () {

            context('when the given value is an object', function () {

                context('when the given object is anonymous', function () {

                    it('should return class@anonymous', function () {

                        $test = $this->type->formatted(new class {});

                        expect($test)->toEqual('instance of class@anonymous');

                    });

                });

                context('when the given object is not anonymous', function () {

                    it('should return object class name', function () {

                        $test = $this->type->formatted(new Test\TestClass);

                        expect($test)->toEqual(sprintf('instance of %s', Test\TestClass::class));

                    });

                });

            });

            context('when the given value is not an object', function () {

                it('should return the result of gettype()', function () {

                    $test = $this->type->formatted(1);

                    expect($test)->toEqual('integer');

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

                expect($test)->toEqual(sprintf('an array of %s instances', Test\TestClass::class));

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

        describe('->formatted()', function () {

            context('when the given value is an object', function () {

                context('when the given object is anonymous', function () {

                    it('should return class@anonymous', function () {

                        $test = $this->type->formatted(new class {});

                        expect($test)->toEqual('instance of class@anonymous');

                    });

                });

                context('when the given object is not anonymous', function () {

                    it('should return object class name', function () {

                        $test = $this->type->formatted(new Test\TestClass);

                        expect($test)->toEqual(sprintf('instance of %s', Test\TestClass::class));

                    });

                });

            });

            context('when the given value is not an object', function () {

                it('should return the result of gettype()', function () {

                    $test = $this->type->formatted(1);

                    expect($test)->toEqual('integer');

                });

            });

        });

    });

});