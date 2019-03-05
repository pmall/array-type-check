<?php

use Quanta\ArrayTypeCheck\Success;
use Quanta\ArrayTypeCheck\ResultInterface;

describe('Success', function () {

    beforeEach(function () {

        $this->result = new Success([
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ]);

    });

    it('should implement ResultInterface', function () {

        expect($this->result)->toBeAnInstanceOf(ResultInterface::class);

    });

    describe('->isValid()', function () {

        it('should return true', function () {

            $test = $this->result->isValid();

            expect($test)->toBeTruthy();

        });

    });

    describe('->with()', function () {

        it('should return a new Success with the given key prepending its path', function () {

            $test = $this->result->with('test');

            expect($test)->toEqual(new Success([
                'test' => [
                    'key1' => 'value1',
                    'key2' => 'value2',
                    'key3' => 'value3',
                ],
            ]));

        });

    });

    describe('->sanitized()', function () {

        it('should return the valid array', function () {

            $test = $this->result->sanitized();

            expect($test)->toEqual([
                'key1' => 'value1',
                'key2' => 'value2',
                'key3' => 'value3',
            ]);

        });

    });

    describe('->message()', function () {

        it('should throw a LogicException', function () {

            expect([$this->result, 'message'])->toThrow(new LogicException);

        });

    });

});
