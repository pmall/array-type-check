<?php

use function Eloquent\Phony\Kahlan\mock;

use Quanta\ArrayTypeCheck\Failure;
use Quanta\ArrayTypeCheck\TypeInterface;
use Quanta\ArrayTypeCheck\ResultInterface;

describe('Failure', function () {

    beforeEach(function () {

        $this->type = mock(TypeInterface::class);

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

        it('should return the value formatted by the type', function () {

            $this->type->formatted->with('invalid')->returns('formatted');

            $test = $this->result->given();

            expect($test)->toEqual('formatted');

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

    describe('->sanitized()', function () {

        it('should throw a LogicException', function () {

            expect([$this->result, 'sanitized'])->toThrow(new LogicException);

        });

    });

});
