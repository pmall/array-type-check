<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class Type implements TypeInterface
{
    /**
     * The type the values must have. Can be a built in type name, 'callable',
     * an interface name or a class name.
     *
     * @var string
     */
    private $type;

    /**
     * Constructor.
     *
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * @inheritdoc
     */
    public function str(): string
    {
        return $this->type;
    }

    /**
     * @inheritdoc
     */
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
