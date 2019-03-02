<?php

use function Eloquent\Phony\Kahlan\mock;

use Quanta\ArrayTypeCheck;
use Quanta\ArrayTypeCheckInterface;
use Quanta\ArrayTypeCheck\Success;
use Quanta\ArrayTypeCheck\Type;
use Quanta\ArrayTypeCheck\Failure;
use Quanta\ArrayTypeCheck\RootFailure;
use Quanta\ArrayTypeCheck\ResultWithKey;
use Quanta\ArrayTypeCheck\TypeInterface;

describe('ArrayTypeCheck::result()', function () {

    context('when the type check is a success', function () {

        it('should return a success', function () {

            $test = ArrayTypeCheck::result(['key' => [true, false, true]], 'boolean', 'key');

            expect($test)->toEqual(ResultWithKey::nested(
                new Success([true, false, true]), 'key'
            ));

        });

    });

    context('when the type check is a failure', function () {

        it('should return a failure', function () {

            $test = ArrayTypeCheck::result(['key' => [true, 1, true]], 'boolean', 'key');

            expect($test)->toEqual(ResultWithKey::nested(
                new Failure(1, new Type('boolean'), '1'), 'key'
            ));

        });

    });

});

describe('ArrayTypeCheck', function () {

    beforeEach(function () {

        $this->type = mock(TypeInterface::class);

        $this->type->isValid->with('valid1')->returns(true);
        $this->type->isValid->with('valid2')->returns(true);
        $this->type->isValid->with('invalid')->returns(false);

    });

    context('when there is no sub key', function () {

        beforeEach(function () {

            $this->check = new ArrayTypeCheck($this->type->get());

        });

        it('should implement ArrayTypeCheckInterface', function () {

            expect($this->check)->toBeAnInstanceOf(ArrayTypeCheckInterface::class);

        });

        describe('->validated()', function () {

            context('when the given value is not an array', function () {

                it('should return a failure', function () {

                    $test = $this->check->checked(1);

                    expect($test)->toEqual(new RootFailure(1));

                });

            });

            context('when the given value is an array', function () {

                context('when the given array is empty', function () {

                    it('should return a success', function () {

                        $test = $this->check->checked([]);

                        expect($test)->toEqual(new Success([]));

                    });

                });

                context('when the given array is not empty', function () {

                    context('when all the values of the given array are valid', function () {

                        it('should return a success', function () {

                            $test = $this->check->checked(['valid1', 'valid2', 'valid1']);

                            expect($test)->toEqual(new Success(['valid1', 'valid2', 'valid1']));

                        });

                    });

                    context('when a value of the given array is not valid', function () {

                        it('should return a failure', function () {

                            $test = $this->check->checked(['valid1', 'invalid', 'valid1']);

                            expect($test)->toEqual(new Failure('invalid', $this->type->get(), '1'));

                        });

                    });

                });

            });

        });

    });

    context('when there is sub keys', function () {

        context('when no sub key is *', function () {

            beforeEach(function () {

                $this->check = new ArrayTypeCheck($this->type->get(), 'key1', 'key2', 'key3');

            });

            it('should implement ArrayTypeCheckInterface', function () {

                expect($this->check)->toBeAnInstanceOf(ArrayTypeCheckInterface::class);

            });

            describe('->validated()', function () {

                context('when the given value is not an array', function () {

                    it('should return a failure', function () {

                        $test = $this->check->checked(1);

                        expect($test)->toEqual(new RootFailure(1));

                    });

                });

                context('when the given value is an array', function () {

                    context('when given array does not contain all the sub keys', function () {

                        it('should return a success', function () {

                            $test = $this->check->checked(['key1' => []]);

                            expect($test)->toEqual(ResultWithKey::nested(
                                new Success([]), 'key1', 'key2', 'key3'
                            ));

                        });

                    });

                    context('when given array contains all the sub keys', function () {

                        context('when the nested array is empty', function () {

                            it('should return a success', function () {

                                $test = $this->check->checked([
                                    'key1' => [
                                        'key2' => [
                                            'key3' => [],
                                        ],
                                    ],
                                ]);

                                expect($test)->toEqual(ResultWithKey::nested(
                                    new Success([]), 'key1', 'key2', 'key3'
                                ));

                            });

                        });

                        context('when the nested array is not empty', function () {

                            context('when all the values of the given array are valid', function () {

                                it('should return a success', function () {

                                    $test = $this->check->checked([
                                        'key1' => [
                                            'key2' => [
                                                'key3' => ['valid1', 'valid2', 'valid1'],
                                            ],
                                        ],
                                    ]);

                                    expect($test)->toEqual(ResultWithKey::nested(
                                        new Success(['valid1', 'valid2', 'valid1']), 'key1', 'key2', 'key3'
                                    ));

                                });

                            });

                            context('when a value of the given array is not valid', function () {

                                it('should return a failure', function () {

                                    $test = $this->check->checked([
                                        'key1' => [
                                            'key2' => [
                                                'key3' => ['valid1', 'invalid', 'valid1'],
                                            ],
                                        ],
                                    ]);

                                    expect($test)->toEqual(ResultWithKey::nested(
                                        new Failure('invalid', $this->type->get(), '1'), 'key1', 'key2', 'key3'
                                    ));

                                });

                            });

                        });

                    });

                });

            });

        });

        context('when a sub key is *', function () {

            beforeEach(function () {

                $this->check = new ArrayTypeCheck($this->type->get(), 'key1', 'key2', '*', 'key3');

            });

            it('should implement ArrayTypeCheckInterface', function () {

                expect($this->check)->toBeAnInstanceOf(ArrayTypeCheckInterface::class);

            });

            describe('->validated()', function () {

                context('when the given value is not an array', function () {

                    it('should return a failure', function () {

                        $test = $this->check->checked(1);

                        expect($test)->toEqual(new RootFailure(1));

                    });

                });

                context('when the given value is an array', function () {

                    context('when given array does not contain all the sub keys', function () {

                        it('should return a success', function () {

                            $test = $this->check->checked(['key1' => []]);

                            expect($test)->toEqual(ResultWithKey::nested(
                                new Success([]), 'key1', 'key2'
                            ));

                        });

                    });

                    context('when given array contains all the sub keys', function () {

                        context('when the nested array is empty', function () {

                            it('should return a success', function () {

                                $test = $this->check->checked([
                                    'key1' => [
                                        'key2' => [
                                            ['key3' => []],
                                            ['key3' => []],
                                            ['key3' => []],
                                        ],
                                    ],
                                ]);

                                expect($test)->toEqual(ResultWithKey::nested(
                                    new Success([
                                        ['key3' => []],
                                        ['key3' => []],
                                        ['key3' => []],
                                    ]),
                                    'key1',
                                    'key2'
                                ));

                            });

                        });

                        context('when the nested array is not empty', function () {

                            context('when all the values of the given array are valid', function () {

                                it('should return a success', function () {

                                    $test = $this->check->checked([
                                        'key1' => [
                                            'key2' => [
                                                ['key3' => ['valid1', 'valid2', 'valid1']],
                                                ['key3' => ['valid1', 'valid2', 'valid1']],
                                                ['key3' => ['valid1', 'valid2', 'valid1']],
                                            ],
                                        ],
                                    ]);

                                    expect($test)->toEqual(ResultWithKey::nested(
                                        new Success([
                                            ['key3' => ['valid1', 'valid2', 'valid1']],
                                            ['key3' => ['valid1', 'valid2', 'valid1']],
                                            ['key3' => ['valid1', 'valid2', 'valid1']],
                                        ]),
                                        'key1',
                                        'key2'
                                    ));

                                });

                            });

                            context('when a value of the given array is not valid', function () {

                                it('should return a failure', function () {

                                    $test = $this->check->checked([
                                        'key1' => [
                                            'key2' => [
                                                ['key3' => ['valid1', 'valid2', 'valid1']],
                                                ['key3' => ['valid1', 'invalid', 'valid1']],
                                                ['key3' => ['valid1', 'valid2', 'valid1']],
                                            ],
                                        ],
                                    ]);

                                    expect($test)->toEqual(ResultWithKey::nested(
                                        new Failure('invalid', $this->type->get(), '1'), 'key1', 'key2', '1', 'key3'
                                    ));

                                });

                            });

                        });

                    });

                });

            });

        });

    });

});
