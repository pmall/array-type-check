<?php

use Quanta\ArrayTypeCheck\RootFailure;
use Quanta\ArrayTypeCheck\ResultInterface;
use Quanta\ArrayTypeCheck\InvalidArrayMessage;
use Quanta\ArrayTypeCheck\RootFailureFormatter;

describe('RootFailure', function () {

    context('when there is no path', function () {

        beforeEach(function () {

            $this->result = new RootFailure('invalid', 'key');

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

            it('should return non array value', function () {

                $test = $this->result->given();

                expect($test)->toEqual('invalid');

            });

        });

        describe('->path()', function () {

            it('should return an empty array', function () {

                $test = $this->result->path();

                expect($test)->toEqual(['key']);

            });

        });

        describe('->with()', function () {

            it('should return a new RootFailure with the given key', function () {

                $test = $this->result->with('test');

                expect($test)->toEqual(new RootFailure('invalid', 'key', 'test'));

            });

        });

        describe('->sanitized()', function () {

            it('should throw a LogicException', function () {

                expect([$this->result, 'sanitized'])->toThrow(new LogicException);

            });

        });

        describe('->message()', function () {

            it('should return a new InvalidArrayMessage with a RootFailureFormatter', function () {

                $test = $this->result->message();

                expect($test)->toEqual(
                    new InvalidArrayMessage(
                        new RootFailureFormatter($this->result)
                    )
                );

            });

        });

    });

    context('when there is a path', function () {

        beforeEach(function () {

            $this->result = new RootFailure('invalid', 'key', ...[
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

            it('should return non array value', function () {

                $test = $this->result->given();

                expect($test)->toEqual('invalid');

            });

        });

        describe('->path()', function () {

            it('should return an empty array', function () {

                $test = $this->result->path();

                expect($test)->toEqual(['key1', 'key2', 'key3', 'key']);

            });

        });

        describe('->with()', function () {

            it('should return a new RootFailure with the given key', function () {

                $test = $this->result->with('test');

                expect($test)->toEqual(new RootFailure('invalid', 'key', ...[
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

            it('should return a new InvalidArrayMessage with a RootFailureFormatter', function () {

                $test = $this->result->message();

                expect($test)->toEqual(
                    new InvalidArrayMessage(
                        new RootFailureFormatter($this->result)
                    )
                );

            });

        });

    });

});
