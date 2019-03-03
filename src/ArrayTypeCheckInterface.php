<?php declare(strict_types=1);

namespace Quanta;

use Quanta\ArrayTypeCheck\ResultInterface;

interface ArrayTypeCheckInterface
{
    /**
     * Return an array type check result for the given array.
     *
     * @param array $array
     * @return \Quanta\ArrayTypeCheck\ResultInterface
     */
     public function checked(array $array): ResultInterface;
}
