<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

interface TypeInterface
{
    public function str(): string;

    public function isValid($value): bool;
}
