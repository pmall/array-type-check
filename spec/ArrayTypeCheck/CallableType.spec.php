<?php

use Quanta\ArrayTypeCheck\{
    CallableType,
    TypeInterface,
};

describe('CallableType', function () {

    beforeEach(function () {

        $this->type = new CallableType;

    });

    it('should implement TypeInterface', function () {

        expect($this->type)->toBeAnInstanceOf(TypeInterface::class);

    });

    describe('->isAccepting()', function () {

        context('when the given value is a callable', function () {

            it('should be truthy', function () {

                $test = $this->type->isAccepting(function () {});

                expect($test)->toBeTruthy();

            });

        });

        context('when the given value is not a callable', function () {

            it('should be falsy', function () {

                $test = $this->type->isAccepting(1);

                expect($test)->toBeFalsy();

            });

        });

    });

    describe('->message()', function () {

        it('should return an error message for any given value', function () {

            $test = function ($value) {
                return $this->type->message('source', 'key', $value);
            };

            $expected = function (string $given) {
                return sprintf('source must be an array of callable values, %s given for key [key]', $given);
            };

            expect($test(true))->toEqual($expected('boolean'));
            expect($test(1))->toEqual($expected('integer'));
            expect($test(1.1))->toEqual($expected('float'));
            expect($test('test'))->toEqual($expected('string'));
            expect($test([]))->toEqual($expected('array'));
            expect($test(new class {}))->toEqual($expected('object'));
            expect($test(tmpfile()))->toEqual($expected('resource'));
            expect($test(null))->toEqual($expected('null'));

        });

    });

});
