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
     * Return a new result by adding the given key to its path.
     *
     * @param string $key
     * @return \Quanta\ArrayTypeCheck\ResultInterface
     */
    public function with(string $key): ResultInterface;

    /**
     * Return the sanitized array.
     *
     * Should throw when `isValid()` returns false.
     *
     * @return array
     */
    public function sanitized(): array;

    /**
     * Return an InvalidArrayMessage.
     *
     * Should throw when `isValid()` returns true.
     */
    public function message(): InvalidArrayMessage;
}
