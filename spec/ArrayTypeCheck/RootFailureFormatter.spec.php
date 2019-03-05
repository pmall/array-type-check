<?php

use Quanta\ArrayTypeCheck\RootFailure;
use Quanta\ArrayTypeCheck\RootFailureFormatter;
use Quanta\ArrayTypeCheck\FailureFormatterInterface;

describe('RootFailureFormatter', function () {

    context('when the invalid value is a boolean', function () {

        context('when there is no path', function () {

            beforeEach(function () {

                $this->formatter = new RootFailureFormatter(
                    new RootFailure(true, 'key')
                );

            });

            it('should implement FailureFormatterInterface', function () {

                expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

            });

            describe('->__invoke()', function () {

                it('should return a formatted message for a boolean', function () {

                    $test = ($this->formatter)('Source');

                    expect($test)->toEqual('Key [key] of source must be an array, boolean given');

                });

            });

        });

        context('when there is a path', function () {

            beforeEach(function () {

                $this->formatter = new RootFailureFormatter(
                    new RootFailure(true, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ])
                );

            });

            it('should implement FailureFormatterInterface', function () {

                expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

            });

            describe('->__invoke()', function () {

                it('should return a formatted message for a boolean', function () {

                    $test = ($this->formatter)('Source');

                    expect($test)->toEqual('Key [key1][key2][key3][key] of source must be an array, boolean given');

                });

            });

        });

    });

    context('when the invalid value is an integer', function () {

        context('when there is no path', function () {

            beforeEach(function () {

                $this->formatter = new RootFailureFormatter(
                    new RootFailure(1, 'key')
                );

            });

            it('should implement FailureFormatterInterface', function () {

                expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

            });

            describe('->__invoke()', function () {

                it('should return a formatted message for an integer', function () {

                    $test = ($this->formatter)('Source');

                    expect($test)->toEqual('Key [key] of source must be an array, integer given');

                });

            });

        });

        context('when there is a path', function () {

            beforeEach(function () {

                $this->formatter = new RootFailureFormatter(
                    new RootFailure(1, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ])
                );

            });

            it('should implement FailureFormatterInterface', function () {

                expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

            });

            describe('->__invoke()', function () {

                it('should return a formatted message for an integer', function () {

                    $test = ($this->formatter)('Source');

                    expect($test)->toEqual('Key [key1][key2][key3][key] of source must be an array, integer given');

                });

            });

        });

    });

    context('when the invalid value is a float', function () {

        context('when there is no path', function () {

            beforeEach(function () {

                $this->formatter = new RootFailureFormatter(
                    new RootFailure(1.1, 'key')
                );

            });

            it('should implement FailureFormatterInterface', function () {

                expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

            });

            describe('->__invoke()', function () {

                it('should return a formatted message for a float', function () {

                    $test = ($this->formatter)('Source');

                    expect($test)->toEqual('Key [key] of source must be an array, float given');

                });

            });

        });

        context('when there is a path', function () {

            beforeEach(function () {

                $this->formatter = new RootFailureFormatter(
                    new RootFailure(1.1, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ])
                );

            });

            it('should implement FailureFormatterInterface', function () {

                expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

            });

            describe('->__invoke()', function () {

                it('should return a formatted message for a float', function () {

                    $test = ($this->formatter)('Source');

                    expect($test)->toEqual('Key [key1][key2][key3][key] of source must be an array, float given');

                });

            });

        });

    });

    context('when the invalid value is a string', function () {

        context('when there is no path', function () {

            beforeEach(function () {

                $this->formatter = new RootFailureFormatter(
                    new RootFailure('value', 'key')
                );

            });

            it('should implement FailureFormatterInterface', function () {

                expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

            });

            describe('->__invoke()', function () {

                it('should return a formatted message for a string', function () {

                    $test = ($this->formatter)('Source');

                    expect($test)->toEqual('Key [key] of source must be an array, string given');

                });

            });

        });

        context('when there is a path', function () {

            beforeEach(function () {

                $this->formatter = new RootFailureFormatter(
                    new RootFailure('value', 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ])
                );

            });

            it('should implement FailureFormatterInterface', function () {

                expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

            });

            describe('->__invoke()', function () {

                it('should return a formatted message for a string', function () {

                    $test = ($this->formatter)('Source');

                    expect($test)->toEqual('Key [key1][key2][key3][key] of source must be an array, string given');

                });

            });

        });

    });

    context('when the invalid value is an object', function () {

        context('when there is no path', function () {

            beforeEach(function () {

                $this->formatter = new RootFailureFormatter(
                    new RootFailure(new class {}, 'key')
                );

            });

            it('should implement FailureFormatterInterface', function () {

                expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

            });

            describe('->__invoke()', function () {

                it('should return a formatted message for an object', function () {

                    $test = ($this->formatter)('Source');

                    expect($test)->toEqual('Key [key] of source must be an array, object given');

                });

            });

        });

        context('when there is a path', function () {

            beforeEach(function () {

                $this->formatter = new RootFailureFormatter(
                    new RootFailure(new class {}, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                        ])
                );

            });

            it('should implement FailureFormatterInterface', function () {

                expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

            });

            describe('->__invoke()', function () {

                it('should return a formatted message for an object', function () {

                    $test = ($this->formatter)('Source');

                    expect($test)->toEqual('Key [key1][key2][key3][key] of source must be an array, object given');

                });

            });

        });

    });

    context('when the invalid value is a resource', function () {

        context('when there is no path', function () {

            beforeEach(function () {

                $this->formatter = new RootFailureFormatter(
                    new RootFailure(tmpfile(), 'key')
                );

            });

            it('should implement FailureFormatterInterface', function () {

                expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

            });

            describe('->__invoke()', function () {

                it('should return a formatted message for a resource', function () {

                    $test = ($this->formatter)('Source');

                    expect($test)->toEqual('Key [key] of source must be an array, resource given');

                });

            });

        });

        context('when there is a path', function () {

            beforeEach(function () {

                $this->formatter = new RootFailureFormatter(
                    new RootFailure(tmpfile(), 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ])
                );

            });

            it('should implement FailureFormatterInterface', function () {

                expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

            });

            describe('->__invoke()', function () {

                it('should return a formatted message for a resource', function () {

                    $test = ($this->formatter)('Source');

                    expect($test)->toEqual('Key [key1][key2][key3][key] of source must be an array, resource given');

                });

            });

        });

    });

    context('when the invalid value is null', function () {

        context('when there is no path', function () {

            beforeEach(function () {

                $this->formatter = new RootFailureFormatter(
                    new RootFailure(null, 'key')
                );

            });

            it('should implement FailureFormatterInterface', function () {

                expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

            });

            describe('->__invoke()', function () {

                it('should return a formatted message for null', function () {

                    $test = ($this->formatter)('Source');

                    expect($test)->toEqual('Key [key] of source must be an array, null given');

                });

            });

        });

        context('when there is a path', function () {

            beforeEach(function () {

                $this->formatter = new RootFailureFormatter(
                    new RootFailure(null, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ])
                );

            });

            it('should implement FailureFormatterInterface', function () {

                expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

            });

            describe('->__invoke()', function () {

                it('should return a formatted message for null', function () {

                    $test = ($this->formatter)('Source');

                    expect($test)->toEqual('Key [key1][key2][key3][key] of source must be an array, null given');

                });

            });

        });

    });

});
