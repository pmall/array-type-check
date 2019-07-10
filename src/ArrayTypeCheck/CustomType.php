<?php

declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class CustomType implements TypeInterface
{
    /**
     * The interface/class name the value must implement/be an instance of.
     *
     * @var string
     */
    private $class;

    /**
     * Constructor.
     *
     * @param string $class
     * @throws \InvalidArgumentException
     */
    public function __construct(string $class)
    {
        if (! interface_exists($class) && ! class_exists($class)) {
            throw new \InvalidArgumentException(
                sprintf('Argument 1 of %s::__construct() must be an existing interface or class name', self::class)
            );
        }

        $this->class = $class;
    }

    /**
     * @inheritdoc
     */
    public function isAccepting($value): bool
    {
        return $value instanceof $this->class;
    }

    /**
     * @inheritdoc
     */
    public function message(string $source, string $key, $value): string
    {
        $tpl = interface_exists($this->class)
            ? '%s must be an array of %s implementations, %s given for key [%s]'
            : '%s must be an array of %s instances, %s given for key [%s]';

        return vsprintf($tpl, [
            $source,
            $this->class,
            is_object($value)
                ? sprintf('instance of %s', new ClassName($value))
                : new TypeStr($value),
            $key
        ]);
    }
}
