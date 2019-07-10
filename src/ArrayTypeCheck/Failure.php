<?php

declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class Failure implements ResultInterface
{
    /**
     * The expected type.
     *
     * @var \Quanta\ArrayTypeCheck\TypeInterface
     */
    private $type;

    /**
     * The key of the value with an invalid type.
     *
     * @var string
     */
    private $key;

    /**
     * The value with an invalid type.
     *
     * @var mixed
     */
    private $value;

    /**
     * Constructor.
     *
     * @param \Quanta\ArrayTypeCheck\TypeInterface  $type
     * @param string                                $key
     * @param mixed                                 $value
     */
    public function __construct(TypeInterface $type, string $key, $value)
    {
        $this->type = $type;
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    public function isValid(): bool
    {
        return false;
    }

    /**
     * Return an error message for the array coming from the given source.
     *
     * @return string
     */
    public function source(string $source): string
    {
        return $this->type->message($source, $this->key, $this->value);
    }

    /**
     * Return an invalid argument exception message for a function call.
     *
     * @param string    $function
     * @param int       $position
     * @return string
     */
    public function function(string $function, int $position): string
    {
        return $this->source(sprintf('Argument %s passed to %s()', $position, $function));
    }

    /**
     * Return an invalid argument exception message for a closure call.
     *
     * @param int $position
     * @return string
     */
    public function closure(int $position): string
    {
        return $this->function('{closure}', $position);
    }

    /**
     * Return an invalid argument exception message for a static method call.
     *
     * @param string    $class
     * @param string    $method
     * @param int       $position
     * @return string
     */
    public function static(string $class, string $method, int $position): string
    {
        return $this->function(sprintf('%s::%s', $class, $method), $position);
    }

    /**
     * Return an invalid argument exception message for a method call.
     *
     * @param object    $object
     * @param string    $method
     * @param int       $position
     * @return string
     */
    public function method($object, string $method, int $position): string
    {
        return $this->static((string) new ClassName($object), $method, $position);
    }

    /**
     * Return an invalid argument exception message for a constructor call.
     *
     * @param object    $object
     * @param int       $position
     * @return string
     */
    public function constructor($object, int $position): string
    {
        return $this->method($object, '__construct', $position);
    }
}
