<?php

use function Eloquent\Phony\Kahlan\mock;

use Quanta\ArrayTypeCheck\Failure;
use Quanta\ArrayTypeCheck\TypeInterface;
use Quanta\ArrayTypeCheck\ResultInterface;
use Quanta\ArrayTypeCheck\FailureFormatter;
use Quanta\ArrayTypeCheck\InvalidArrayMessage;

describe('Failure', function () {

    beforeEach(function () {

        $this->type = mock(TypeInterface::class);

    });

    context('when there is no path', function () {

        beforeEach(function () {

            $this->result = new Failure('invalid', $this->type->get(), 'key');

        });

        it('should implement ResultInterface', function () {

            expect($this->result)->toBeAnInstanceOf(ResultInterface::class);

        });

        describe('->isValid()', function () {

            it('should return false', function () {

                $test = $this->result->isValid();

                expect($test)->toBeFalsy();

            });

        });

        describe('->given()', function () {

            it('should return the value with an invalid type', function () {

                $test = $this->result->given();

                expect($test)->toEqual('invalid');

            });

        });

        describe('->expected()', function () {

            it('should return the string representation of the type', function () {

                $this->type->str->returns('type');

                $test = $this->result->expected();

                expect($test)->toEqual('type');

            });

        });

        describe('->path()', function () {

            it('should return an array containing the key', function () {

                $test = $this->result->path();

                expect($test)->toEqual(['key']);

            });

        });

        describe('->with()', function () {

            it('should return a new Failure with the given key', function () {

                $test = $this->result->with('test');

                expect($test)->toEqual(new Failure('invalid', $this->type->get(), 'key', 'test'));

            });

        });

        describe('->sanitized()', function () {

            it('should throw a LogicException', function () {

                expect([$this->result, 'sanitized'])->toThrow(new LogicException);

            });

        });

        describe('->message()', function () {

            it('should return a new InvalidArrayMessage with a FailureFormatter', function () {

                $this->type->str->returns('type');

                $test = $this->result->message();

                expect($test)->toEqual(
                    new InvalidArrayMessage(
                        new FailureFormatter('invalid', 'type', 'key')
                    )
                );

            });

        });

    });

    context('when there is a path', function () {

        beforeEach(function () {

            $this->result = new Failure('invalid', $this->type->get(), 'key', ...[
                'key1',
                'key2',
                'key3',
            ]);

        });

        it('should implement ResultInterface', function () {

            expect($this->result)->toBeAnInstanceOf(ResultInterface::class);

        });

        describe('->isValid()', function () {

            it('should return false', function () {

                $test = $this->result->isValid();

                expect($test)->toBeFalsy();

            });

        });

        describe('->given()', function () {

            it('should return the value with an invalid type', function () {

                $test = $this->result->given();

                expect($test)->toEqual('invalid');

            });

        });

        describe('->expected()', function () {

            it('should return the string representation of the type', function () {

                $this->type->str->returns('type');

                $test = $this->result->expected();

                expect($test)->toEqual('type');

            });

        });

        describe('->path()', function () {

            it('should return an array containing the key', function () {

                $test = $this->result->path();

                expect($test)->toEqual(['key1', 'key2', 'key3', 'key']);

            });

        });

        describe('->with()', function () {

            it('should return a new Failure with the given key', function () {

                $test = $this->result->with('test');

                expect($test)->toEqual(new Failure('invalid', $this->type->get(), 'key', ...[
                    'test',
                    'key1',
                    'key2',
                    'key3',
                ]));

            });

        });

        describe('->sanitized()', function () {

            it('should throw a LogicException', function () {

                expect([$this->result, 'sanitized'])->toThrow(new LogicException);

            });

        });

        describe('->message()', function () {

            it('should return a new InvalidArrayMessage with a FailureFormatter', function () {

                $this->type->str->returns('type');

                $test = $this->result->message();

                expect($test)->toEqual(
                    new InvalidArrayMessage(
                        new FailureFormatter('invalid', 'type', 'key', ...[
                            'key1',
                            'key2',
                            'key3',
                        ])
                    )
                );

            });

        });

    });

});
