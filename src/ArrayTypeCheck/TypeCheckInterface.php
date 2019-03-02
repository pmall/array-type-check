<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

interface TypeCheckInterface
{
    public function expected(): string;

    public function isValid($value): bool;
}
