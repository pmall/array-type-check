<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class Success implements ResultInterface
{
    private $given;

    public function __construct(array $given)
    {
        $this->given = $given;
    }

    public function isValid(): bool
    {
        return true;
    }

    public function given()
    {
        throw new \LogicException('The array is valid');
    }

    public function expected(): string
    {
        throw new \LogicException('The array is valid');
    }

    public function path(): array
    {
        throw new \LogicException('The array is valid');
    }

    public function sanitized(): array
    {
        return $this->given;
    }
}
