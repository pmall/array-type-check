<?php

declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

interface TypeInterface
{
    /**
     * Return whether the given value has the type.
     *
     * @param mixed $value
     * @return bool
     */
    public function isAccepting($value): bool;

    /**
     * Return an error message for the given array source, the key of the first
     * invalid value and the first invalid value.
     *
     * @param string $source
     * @param string $key
     * @param mixed $value
     * @return string
     */
    public function message(string $source, string $key, $value): string;
}
