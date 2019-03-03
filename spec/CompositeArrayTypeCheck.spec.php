<?php

use function Eloquent\Phony\Kahlan\mock;

use Quanta\ArrayTypeCheckInterface;
use Quanta\CompositeArrayTypeCheck;
use Quanta\ArrayTypeCheck\Success;
use Quanta\ArrayTypeCheck\Failure;
use Quanta\ArrayTypeCheck\TypeInterface;

describe('CompositeArrayTypeCheck', function () {

    context('when there is no array type check', function () {

        beforeEach(function () {

            $this->check = new CompositeArrayTypeCheck;

        });

        it('should implement ArrayTypeCheckInterface', function () {

            expect($this->check)->toBeAnInstanceOf(ArrayTypeCheckInterface::class);

        });

        describe('->checked()', function () {

            it('should return an empty Success', function () {

                $test = $this->check->checked(['valid', 'valid', 'valid']);

                expect($test)->toEqual(new Success([]));

            });

        });

    });

    context('when there is at least one array type check', function () {

        beforeEach(function () {

            $this->check1 = mock(ArrayTypeCheckInterface::class);
            $this->check2 = mock(ArrayTypeCheckInterface::class);
            $this->check3 = mock(ArrayTypeCheckInterface::class);

            $this->check = new CompositeArrayTypeCheck(...[
                $this->check1->get(),
                $this->check2->get(),
                $this->check3->get(),
            ]);

        });

        it('should implement ArrayTypeCheckInterface', function () {

            expect($this->check)->toBeAnInstanceOf(ArrayTypeCheckInterface::class);

        });

        describe('->checked()', function () {

            context('when all the array type checks are passing', function () {

                it('should return a merged Success', function () {

                    $array = ['valid', 'valid', 'valid'];

                    $this->check1->checked->with($array)->returns(new Success(['test' => ['key1' => ['valid']]]));
                    $this->check2->checked->with($array)->returns(new Success(['test' => ['key2' => ['valid']]]));
                    $this->check3->checked->with($array)->returns(new Success(['test' => ['key3' => ['valid']]]));

                    $test = $this->check->checked($array);

                    expect($test)->toEqual(new Success([
                        'test' => [
                            'key1' => ['valid'],
                            'key2' => ['valid'],
                            'key3' => ['valid'],
                        ],
                    ]));

                });

            });

            context('when at least one type check is failing', function () {

                it('should return the first failure', function () {

                    $array = ['valid', 'valid', 'valid'];

                    $failure = new Failure(1, mock(TypeInterface::class)->get(), '1');

                    $this->check1->checked->with($array)->returns(new Success(['test' => ['key1' => ['valid']]]));
                    $this->check2->checked->with($array)->returns($failure);
                    $this->check3->checked->with($array)->returns(new Success(['test' => ['key3' => ['valid']]]));

                    $test = $this->check->checked($array);

                    expect($test)->toBe($failure);

                });

            });

        });

    });

});
