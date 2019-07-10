<?php

declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

interface ResultInterface
{
    /**
     * Return whether all the values of the array are typed as expected.
     *
     * @return bool
     */
    public function isValid(): bool;
}
