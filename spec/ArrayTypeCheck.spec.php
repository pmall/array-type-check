<?php

use function Eloquent\Phony\Kahlan\mock;

use Quanta\ArrayTypeCheck;
use Quanta\ArrayTypeCheckInterface;
use Quanta\ArrayTypeCheck\Success;
use Quanta\ArrayTypeCheck\Type;
use Quanta\ArrayTypeCheck\Failure;
use Quanta\ArrayTypeCheck\RootFailure;
use Quanta\ArrayTypeCheck\NestedResult;
use Quanta\ArrayTypeCheck\TypeInterface;

describe('ArrayTypeCheck::result()', function () {

    context('when the type check is a success', function () {

        it('should return a success', function () {

            $test = ArrayTypeCheck::result(['valid', 'valid', 'valid'], 'string');

            expect($test)->toEqual(new Success(['valid', 'valid', 'valid']));

        });

    });

    context('when the type check is a failure', function () {

        it('should return a failure', function () {

            $test = ArrayTypeCheck::result(['valid', 1, 'valid'], 'string');

            expect($test)->toEqual(new Failure(1, new Type('string'), '1'));

        });

    });

});

describe('ArrayTypeCheck', function () {

    beforeEach(function () {

        $this->type = mock(TypeInterface::class);

        $this->type->isValid->with('valid')->returns(true);
        $this->type->isValid->with('invalid')->returns(false);

    });

    context('when there is no sub key', function () {

        beforeEach(function () {

            $this->check = new ArrayTypeCheck($this->type->get());

        });

        it('should implement ArrayTypeCheckInterface', function () {

            expect($this->check)->toBeAnInstanceOf(ArrayTypeCheckInterface::class);

        });

        describe('->checked()', function () {

            context('when the given array is empty', function () {

                it('should return a success', function () {

                    $test = $this->check->checked([]);

                    expect($test)->toEqual(new Success([]));

                });

            });

            context('when the given array is not empty', function () {

                context('when all the values of the given array are valid', function () {

                    it('should return a success', function () {

                        $test = $this->check->checked(['valid', 'valid', 'valid']);

                        expect($test)->toEqual(new Success(['valid', 'valid', 'valid']));

                    });

                });

                context('when a value of the given array is not valid', function () {

                    it('should return a failure', function () {

                        $test = $this->check->checked(['valid', 'invalid', 'valid']);

                        expect($test)->toEqual(new Failure('invalid', $this->type->get(), '1'));

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

            describe('->checked()', function () {

                context('when given array does not contain all the sub keys', function () {

                    it('should return a success', function () {

                        $test = $this->check->checked(['key1' => []]);

                        expect($test)->toEqual(NestedResult::nested(
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

                            expect($test)->toEqual(NestedResult::nested(
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
                                            'key3' => ['valid', 'valid', 'valid'],
                                        ],
                                    ],
                                ]);

                                expect($test)->toEqual(NestedResult::nested(
                                    new Success(['valid', 'valid', 'valid']), 'key1', 'key2', 'key3'
                                ));

                            });

                        });

                        context('when a value of the given array is not valid', function () {

                            it('should return a failure', function () {

                                $test = $this->check->checked([
                                    'key1' => [
                                        'key2' => [
                                            'key3' => ['valid', 'invalid', 'valid'],
                                        ],
                                    ],
                                ]);

                                expect($test)->toEqual(NestedResult::nested(
                                    new Failure('invalid', $this->type->get(), '1'), 'key1', 'key2', 'key3'
                                ));

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

            describe('->checked()', function () {

                context('when given array does not contain all the sub keys', function () {

                    it('should return a success', function () {

                        $test = $this->check->checked(['key1' => []]);

                        expect($test)->toEqual(NestedResult::nested(
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

                            expect($test)->toEqual(NestedResult::nested(
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
                                            ['key3' => ['valid', 'valid', 'valid']],
                                            ['key3' => ['valid', 'valid', 'valid']],
                                            ['key3' => ['valid', 'valid', 'valid']],
                                        ],
                                    ],
                                ]);

                                expect($test)->toEqual(NestedResult::nested(
                                    new Success([
                                        ['key3' => ['valid', 'valid', 'valid']],
                                        ['key3' => ['valid', 'valid', 'valid']],
                                        ['key3' => ['valid', 'valid', 'valid']],
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
                                            ['key3' => ['valid', 'valid', 'valid']],
                                            ['key3' => ['valid', 'invalid', 'valid']],
                                            ['key3' => ['valid', 'valid', 'valid']],
                                        ],
                                    ],
                                ]);

                                expect($test)->toEqual(NestedResult::nested(
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
