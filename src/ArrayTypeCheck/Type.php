<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class Type implements TypeInterface
{
    /**
     * The type value.
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
        if ($this->type == 'callable') {
            return is_callable($value);
        }

        if ($this->type == '*' || strtolower($this->type) == strtolower(gettype($value))) {
            return true;
        }

        if (interface_exists($this->type) || class_exists($this->type)) {
            return $value instanceof $this->type;
        }

        return false;
    }
}
