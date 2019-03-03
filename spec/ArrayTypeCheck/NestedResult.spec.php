<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use Quanta\ArrayTypeCheck\NestedResult;
use Quanta\ArrayTypeCheck\ResultInterface;

describe('NestedResult', function () {

    beforeEach(function () {

        $this->delegate = mock(ResultInterface::class);

        $this->result = new NestedResult($this->delegate->get(), 'key');

    });

    it('should implement ResultInterface', function () {

        expect($this->result)->toBeAnInstanceOf(ResultInterface::class);

    });

    describe('->isValid()', function () {

        context('when the delegate ->isValid() method returns true', function () {

            it('should return true', function () {

                $this->delegate->isValid->returns(true);

                $test = $this->result->isValid();

                expect($test)->toBeTruthy();

            });

        });

        context('when the delegate ->isValid() method returns false', function () {

            it('should return false', function () {

                $this->delegate->isValid->returns(false);

                $test = $this->result->isValid();

                expect($test)->toBeFalsy();

            });

        });

    });

    describe('->given()', function () {

        it('should proxy the delegate ->given() method', function () {

            $this->delegate->given->returns('invalid');

            $test = $this->result->given();

            expect($test)->toEqual('invalid');

        });

    });

    describe('->expected()', function () {

        it('should proxy the delegate ->expected() method', function () {

            $this->delegate->expected->returns('expected');

            $test = $this->result->expected();

            expect($test)->toEqual('expected');

        });

    });

    describe('->path()', function () {

        it('should preprend the path of the delegate with the key', function () {

            $this->delegate->path->returns(['k1', 'k2', 'k3']);

            $test = $this->result->path();

            expect($test)->toEqual(['key', 'k1', 'k2', 'k3']);

        });

    });

    describe('->sanitized()', function () {

        it('should nest the sanitized value of the delegate with the key', function () {

            $this->delegate->sanitized->returns(['k1' => 'v1', 'k2' => 'v1', 'k3' => 'v1']);

            $test = $this->result->sanitized();

            expect($test)->toEqual(['key' => ['k1' => 'v1', 'k2' => 'v1', 'k3' => 'v1']]);

        });

    });

    describe('->formatted()', function () {

        it('should return the string produced by given formatter', function () {

            $this->delegate->given->returns('invalid');
            $this->delegate->expected->returns('type');
            $this->delegate->path->returns(['k1', 'k2', 'k3']);

            $formatter = stub()->with('invalid', 'type', 'key', 'k1', 'k2', 'k3')->returns('formatted');

            $test = $this->result->formatted($formatter);

            expect($test)->toEqual('formatted');

        });

    });

});
