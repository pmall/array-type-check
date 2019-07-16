<?php

declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

interface ResultInterface
{
    /**
     * Return whether the result is a success.
     *
     * @return bool
     */
    public function isSuccess(): bool;

    /**
     * Return whether the result is a failure.
     *
     * @return bool
     */
    public function isFailure(): bool;

    /**
     * Return an exception message for the given source.
     *
     * @return string
     */
    public function message(string $source): string;

    /**
     * Return an invalid argument exception message for a function call.
     *
     * @param string    $function
     * @param int       $position
     * @return string
     */
    public function function(string $function, int $position): string;

    /**
     * Return an invalid argument exception message for a static method call.
     *
     * @param string    $class
     * @param string    $method
     * @param int       $position
     * @return string
     */
    public function static(string $class, string $method, int $position): string;

    /**
     * Return an invalid argument exception message for a method call.
     *
     * @param object    $object
     * @param string    $method
     * @param int       $position
     * @return string
     */
    public function method($object, string $method, int $position): string;

    /**
     * Return an invalid argument exception message for a constructor call.
     *
     * @param object    $object
     * @param int       $position
     * @return string
     */
    public function constructor($object, int $position): string;

    /**
     * Return an invalid argument exception message for a closure call.
     *
     * @param int $position
     * @return string
     */
    public function closure(int $position): string;
}
