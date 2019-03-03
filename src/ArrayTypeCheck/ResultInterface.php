<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

interface ResultInterface
{
    /**
     * Return whether the array type checking has succeeded.
     *
     * @return bool
     */
    public function isValid(): bool;

    /**
     * Return the value having an unexpected type.
     *
     * Should throw when isValid() returns true.
     *
     * @return mixed
     */
    public function given();

    /**
     * Return the expected type.
     *
     * Should throw when isValid() returns true.
     *
     * @return string
     */
    public function expected(): string;

    /**
     * Return the sub key path of the value.
     *
     * Should throw when isValid() returns true.
     *
     * @return array
     */
    public function path(): array;

    /**
     * Return the sanitized array.
     *
     * Should throw when isValid() returns false.
     *
     * @return array
     */
    public function sanitized(): array;

    /**
     * Return a string representation of the result using the given formatter.
     *
     * Should throw when isValid() returns true.
     *
     * @param callable $formatter
     * @return string
     */
    public function formatted(callable $formatter): string;
}
