<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class TypeCheck implements TypeCheckInterface
{
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function expected(): string
    {
        return $this->type;
    }

    public function isValid($value): bool
    {
        if ($this->type == '*') {
            return true;
        }

        if (interface_exists($this->type) || class_exists($this->type)) {
            return $value instanceof $this->type;
        }

        if ($this->type == 'callable') {
            return is_callable($value);
        }

        return strtolower($this->type) == gettype($value);
    }
}
