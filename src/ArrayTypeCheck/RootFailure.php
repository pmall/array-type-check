<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class RootFailure implements ResultInterface
{
    private $given;

    public function __construct($given)
    {
        $this->given = $given;
    }

    public function isValid(): bool
    {
        return false;
    }

    public function given()
    {
        return $this->given;
    }

    public function expected(): string
    {
        return 'array';
    }

    public function path(): array
    {
        return [];
    }

    public function sanitized(): array
    {
        throw new \LogicException('The array is not valid');
    }
}
