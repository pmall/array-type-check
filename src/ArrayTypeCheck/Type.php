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
        if (interface_exists($this->type)) {
            return sprintf('an array of %s implementations', $this->type);
        }

        if (class_exists($this->type)) {
            return sprintf('an array of %s instances', $this->type);
        }

        $map = [
            'callable' => 'an array of callables',
            'boolean' => 'an array of booleans',
            'integer' => 'an array of integers',
            'double' => 'an array of floats',
            'string' => 'an array of strings',
            'array' => 'an array of arrays',
            'object' => 'an array of objects',
            'resource' => 'an array of resources',
        ];

        return $map[$this->type] ?? 'unknown';
    }

    /**
     * @inheritdoc
     */
    public function formatted($given): string
    {
        if (is_object($given) && (interface_exists($this->type) || class_exists($this->type))) {
            $class = get_class($given);

            if (strpos($class, 'class@anonymous') !== false) {
                $class = 'class@anonymous';
            }

            return sprintf('instance of %s', $class);
        }

        return gettype($given);
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
