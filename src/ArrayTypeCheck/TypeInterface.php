<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

interface TypeInterface
{
    /**
     * Return a string representation of the type.
     *
     * Can be a built in type name, 'callable', an interface or class name.
     *
     * @return string
     */
    public function str(): string;

    /**
     * Return whether the given value has this type.
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid($value): bool;
}
