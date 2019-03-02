<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class Failure implements ResultInterface
{
    private $given;

    private $type;

    private $key;

    public function __construct($given, TypeInterface $type, string $key)
    {
        $this->given = $given;
        $this->type = $type;
        $this->key = $key;
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
        return $this->type->str();
    }

    public function path(): array
    {
        return [$this->key];
    }

    public function sanitized(): array
    {
        throw new \LogicException('The array is not valid');
    }
}
