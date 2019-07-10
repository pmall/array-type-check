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
     * @inheritdoc
     */
    public function message(string $source): string
    {
        return $this->type->message($source, $this->key, $this->value);
    }

    /**
     * @inheritdoc
     */
    public function function(string $function, int $position): string
    {
        return $this->message(sprintf('Argument %s passed to %s()', $position, $function));
    }

    /**
     * @inheritdoc
     */
    public function static(string $class, string $method, int $position): string
    {
        return $this->function(sprintf('%s::%s', $class, $method), $position);
    }

    /**
     * @inheritdoc
     */
    public function method($object, string $method, int $position): string
    {
        return $this->static((string) new ClassName($object), $method, $position);
    }

    /**
     * @inheritdoc
     */
    public function constructor($object, int $position): string
    {
        return $this->method($object, '__construct', $position);
    }

    /**
     * @inheritdoc
     */
    public function closure(int $position): string
    {
        return $this->function('{closure}', $position);
    }
}
