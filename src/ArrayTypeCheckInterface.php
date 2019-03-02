<?php declare(strict_types=1);

namespace Quanta;

use Quanta\ArrayTypeCheck\ResultInterface;

interface ArrayTypeCheckInterface
{
    /**
     * Return an array type check result for the given value.
     *
     * @return \Quanta\ArrayTypeCheck\ResultInterface
     */
    public function checked($value): ResultInterface;
}
