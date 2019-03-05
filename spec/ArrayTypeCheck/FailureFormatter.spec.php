<?php

use Quanta\ArrayTypeCheck\FailureFormatter;
use Quanta\ArrayTypeCheck\FailureFormatterInterface;

require_once __DIR__ . '/../.test/classes.php';

describe('FailureFormatter', function () {

    context('when the invalid value is a boolean', function () {

        context('when the expected type is built in', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(true, 'integer', 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of integers, boolean given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(true, 'integer', 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of integers, boolean given for key [key]');

                    });

                });

            });

        });

        context('when the expected type is an interface name', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(true, Test\TestInterface::class, 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of Test\TestInterface implementations, boolean given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(true, Test\TestInterface::class, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of Test\TestInterface implementations, boolean given for key [key]');

                    });

                });

            });

        });

        context('when the expected type is a class name', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(true, Test\TestClass::class, 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of Test\TestClass instances, boolean given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(true, Test\TestClass::class, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of Test\TestClass instances, boolean given for key [key]');

                    });

                });

            });

        });

    });

    context('when the invalid value is a float', function () {

        context('when the expected type is built in', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(1.1, 'integer', 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of integers, float given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(1.1, 'integer', 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of integers, float given for key [key]');

                    });

                });

            });

        });

        context('when the expected type is an interface name', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(1.1, Test\TestInterface::class, 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of Test\TestInterface implementations, float given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(1.1, Test\TestInterface::class, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of Test\TestInterface implementations, float given for key [key]');

                    });

                });

            });

        });

        context('when the expected type is a class name', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(1.1, Test\TestClass::class, 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of Test\TestClass instances, float given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(1.1, Test\TestClass::class, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of Test\TestClass instances, float given for key [key]');

                    });

                });

            });

        });

    });

    context('when the invalid value is null', function () {

        context('when the expected type is built in', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(null, 'integer', 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of integers, null given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(null, 'integer', 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of integers, null given for key [key]');

                    });

                });

            });

        });

        context('when the expected type is an interface name', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(null, Test\TestInterface::class, 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of Test\TestInterface implementations, null given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(null, Test\TestInterface::class, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of Test\TestInterface implementations, null given for key [key]');

                    });

                });

            });

        });

        context('when the expected type is a class name', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(null, Test\TestClass::class, 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of Test\TestClass instances, null given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(null, Test\TestClass::class, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of Test\TestClass instances, null given for key [key]');

                    });

                });

            });

        });

    });

    context('when the invalid value is an anonymous object', function () {

        context('when the expected type is built in', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(new class {}, 'integer', 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of integers, object given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(new class {}, 'integer', 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of integers, object given for key [key]');

                    });

                });

            });

        });

        context('when the expected type is an interface name', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(new class {}, Test\TestInterface::class, 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of Test\TestInterface implementations, instance of class@anonymous given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(new class {}, Test\TestInterface::class, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of Test\TestInterface implementations, instance of class@anonymous given for key [key]');

                    });

                });

            });

        });

        context('when the expected type is a class name', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(new class {}, Test\TestClass::class, 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of Test\TestClass instances, instance of class@anonymous given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(new class {}, Test\TestClass::class, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of Test\TestClass instances, instance of class@anonymous given for key [key]');

                    });

                });

            });

        });

    });

    context('when the invalid value is a non anonymous object', function () {

        context('when the expected type is built in', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(new StdClass, 'integer', 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of integers, object given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(new StdClass, 'integer', 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of integers, object given for key [key]');

                    });

                });

            });

        });

        context('when the expected type is an interface name', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(new StdClass, Test\TestInterface::class, 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of Test\TestInterface implementations, instance of stdClass given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(new StdClass, Test\TestInterface::class, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of Test\TestInterface implementations, instance of stdClass given for key [key]');

                    });

                });

            });

        });

        context('when the expected type is a class name', function () {

            context('when there is no path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(new StdClass, Test\TestClass::class, 'key');

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Source must be an array of Test\TestClass instances, instance of stdClass given for key [key]');

                    });

                });

            });

            context('when there is a path', function () {

                beforeEach(function () {

                    $this->formatter = new FailureFormatter(new StdClass, Test\TestClass::class, 'key', ...[
                        'key1',
                        'key2',
                        'key3',
                    ]);

                });

                it('should implement FailureFormatterInterface', function () {

                    expect($this->formatter)->toBeAnInstanceOf(FailureFormatterInterface::class);

                });

                describe('->__invoke()', function () {

                    it('should return a formatted message for a built in type', function () {

                        $test = ($this->formatter)('Source');

                        expect($test)->toEqual('Key [key1][key2][key3] of source must be an array of Test\TestClass instances, instance of stdClass given for key [key]');

                    });

                });

            });

        });

    });

});
