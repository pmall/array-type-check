<?php

use Quanta\ArrayTypeCheck\{
    Success,
    ResultInterface,
};

describe('Success', function () {

    beforeEach(function () {

        $this->result = new Success;

    });

    it('should implement ResultInterface', function () {

        expect($this->result)->toBeAnInstanceOf(ResultInterface::class);

    });

    describe('->isValid()', function () {

        it('should be truthy', function () {

            $test = $this->result->isValid();

            expect($test)->toBeTruthy();

        });

    });

});
