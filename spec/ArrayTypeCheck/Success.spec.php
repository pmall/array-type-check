<?php

use Quanta\ArrayTypeCheck\{
    Success,
    ResultInterface
};

describe('Success', function () {

    beforeEach(function () {

        $this->result = new Success;

    });

    it('should implement ResultInterface', function () {

        expect($this->result)->toBeAnInstanceOf(ResultInterface::class);

    });

    describe('->isSuccess()', function () {

        it('should be truthy', function () {

            $test = $this->result->isSuccess();

            expect($test)->toBeTruthy();

        });

    });

    describe('->isFailure()', function () {

        it('should be falsy', function () {

            $test = $this->result->isFailure();

            expect($test)->toBeFalsy();

        });

    });

    describe('->message()', function () {

        it('throw a LogicException', function () {

            $test = function () {
                $this->result->message('source');
            };

            expect($test)->toThrow(new LogicException);

        });

    });

    describe('->function()', function () {

        it('throw a LogicException', function () {

            $test = function () {
                $this->result->function('function', 1);
            };

            expect($test)->toThrow(new LogicException);

        });

    });

    describe('->static()', function () {

        it('throw a LogicException', function () {

            $test = function () {
                $this->result->static('class', 'method', 1);
            };

            expect($test)->toThrow(new LogicException);

        });

    });

    describe('->method()', function () {

        it('throw a LogicException', function () {

            $test = function () {
                $this->result->method(new class {}, 'method', 1);
            };

            expect($test)->toThrow(new LogicException);

        });

    });

    describe('->constructor()', function () {

        it('throw a LogicException', function () {

            $test = function () {
                $this->result->constructor(new class {}, 1);
            };

            expect($test)->toThrow(new LogicException);

        });

    });

    describe('->closure()', function () {

        it('throw a LogicException', function () {

            $test = function () {
                $this->result->closure(1);
            };

            expect($test)->toThrow(new LogicException);

        });

    });

});
