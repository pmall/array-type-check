<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

interface ResultInterface
{
    public function isValid(): bool;

    public function given();

    public function expected(): string;

    public function path(): array;

    public function sanitized(): array;
}
