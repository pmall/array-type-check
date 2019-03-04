<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class InvalidArrayMessage
{
    /**
     * The result of the array type checking.
     *
     * @var \Quanta\ArrayTypeCheck\ResultInterface
     */
    private $result;

    /**
     * Constructor.
     *
     * @param \Quanta\ArrayTypeCheck\ResultInterface $result
     */
    public function __construct(ResultInterface $result)
    {
        $this->result = $result;
    }

    /**
     * Return a string representation of the failed array type check result.
     *
     * @return string
     */
    public function source(string $source): string
    {
        $path = $this->result->path();

        if ($this->result->isRoot()) {
            return vsprintf('Key %s of %s must be an array, %s given', [
                implode('', array_map([$this, 'key'], $path)),
                lcfirst($source),
                $this->result->given(),
            ]);
        }

        if (count($path) > 1) {
            return vsprintf('Key %s of %s must be %s, %s given for key %s', [
                implode('', array_map([$this, 'key'], array_slice($path, 0, -1))),
                lcfirst($source),
                $this->result->expected(),
                $this->result->given(),
                $this->key(end($path)),
            ]);
        }

        return vsprintf('%s must be %s, %s given for key %s', [
            ucfirst($source),
            $this->result->expected(),
            $this->result->given(),
            $this->key($path[0]),
        ]);
    }

    /**
     * Return an invalid argument exception for a function call.
     *
     * @param string    $function
     * @param int       $position
     * @return string
     */
    public function function(string $function, int $position): string
    {
        return $this->source(sprintf('argument %s passed to %s()', $position, $function));
    }

    /**
     * Return an invalid argument exception for a closure call.
     *
     * @param int $position
     * @return string
     */
    public function closure(int $position): string
    {
        return $this->function('{closure}', $position);
    }

    /**
     * Return the formatted string for a static method method call.
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
     * Return the formatted string for an instance method call.
     *
     * @param object    $object
     * @param string    $method
     * @param int       $position
     * @return string
     */
    public function method($object, string $method, int $position): string
    {
        $class = get_class($object);

        if (strpos($class, 'class@anonymous') !== false) {
            $class = 'class@anonymous';
        }

        return $this->static($class, $method, $position);
    }

    /**
     * Return an invalid argument exception for a constructor call.
     *
     * @param object    $object
     * @param int       $position
     * @return string
     */
    public function constructor($object, int $position): string
    {
        return $this->method($object, '__construct', $position);
    }

    /**
     * Return the string representation of a key from the given string.
     *
     * @param string $key
     * @return string
     */
    private function key(string $key): string
    {
        return sprintf('[%s]', $key);
    }
}
