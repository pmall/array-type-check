<?php

use Quanta\ArrayTypeCheck\Success;
use Quanta\ArrayTypeCheck\ResultInterface;

describe('Success', function () {

    beforeEach(function () {

        $this->result = new Success(['k1' => 'v1', 'k2' => 'v2', 'k3' => 'v3']);

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

    describe('->given()', function () {

        it('should throw a LogicException', function () {

            expect([$this->result, 'given'])->toThrow(new LogicException);

        });

    });

    describe('->expected()', function () {

        it('should throw a LogicException', function () {

            expect([$this->result, 'expected'])->toThrow(new LogicException);

        });

    });

    describe('->path()', function () {

        it('should throw a LogicException', function () {

            expect([$this->result, 'path'])->toThrow(new LogicException);

        });

    });

    describe('->sanitized()', function () {

        it('should throw a LogicException', function () {

            $test = $this->result->sanitized();

            expect($test)->toEqual(['k1' => 'v1', 'k2' => 'v2', 'k3' => 'v3']);

        });

    });

    describe('->formatted()', function () {

        it('should throw a LogicException', function () {

            $test = function () {
                $this->result->formatted(function () {});
            };

            expect($test)->toThrow(new LogicException);

        });

    });

});
