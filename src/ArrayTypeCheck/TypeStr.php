<?php

declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class TypeStr
{
    /**
     * The value.
     *
     * @var mixed
     */
    private $value;

    /**
     * Constructor.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Return a string representation of the value's type.
     *
     * @return string
     */
    public function __toString()
    {
        $type = strtolower(gettype($this->value));

        return $type == 'double' ? 'float' : $type;
    }
}
