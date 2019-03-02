<?php declare(strict_types=1);

namespace Quanta;

use Quanta\ArrayTypeCheck\ResultInterface;

interface ArrayTypeCheckInterface
{
    /**
     * Return an array type check result from the given value.
     *
     * @return \Quanta\ArrayTypeCheck\ResultInterface
     */
    public function validated($value): ResultInterface;
}
