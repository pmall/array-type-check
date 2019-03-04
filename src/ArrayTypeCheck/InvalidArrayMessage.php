<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class InvalidArrayMessage
{
    /**
     * The source of the array.
     *
     * @var string
     */
    private $source;

    /**
     * The result of the array type checking.
     *
     * @var \Quanta\ArrayTypeCheck\ResultInterface
     */
    private $result;

    /**
     * Return the formatted string for an invalid argument exception.
     *
     * @param string                                    $function
     * @param int                                       $position
     * @param \Quanta\ArrayTypeCheck\ResultInterface    $result
     * @return string
     */
    public static function function(string $function, int $position, ResultInterface $result): string
    {
        return (string) new self(sprintf('argument %s passed to %s()', $position, $function), $result);
    }

    /**
     * Return the formatted string for a closure call.
     *
     * @param int                                       $position
     * @param \Quanta\ArrayTypeCheck\ResultInterface    $result
     * @return string
     */
    public static function closure(int $position, ResultInterface $result): string
    {
        return self::function('{closure}', $position, $result);
    }

    /**
     * Return the formatted string for a method call.
     *
     * @param string|object                             $object
     * @param string                                    $method
     * @param int                                       $position
     * @param \Quanta\ArrayTypeCheck\ResultInterface    $result
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function method($object, string $method, int $position, ResultInterface $result): string
    {
        if (is_object($object)) {
            $class = get_class($object);
            if (strpos($class, 'class@anonymous') !== false) {
                $class = 'class@anonymous';
            }
        } elseif (is_string($object)) {
            $class = $object;
        } else {
            throw new \InvalidArgumentException(
                vsprintf('Argument 1 passed to %s::method() must be a string or an object, %s given', [
                    InvalidArrayMessage::class,
                    gettype($object),
                ])
            );
        }

        return self::function(sprintf('%s::%s', $class, $method), $position, $result);
    }

    /**
     * Constructor.
     *
     * @param string                                    $source
     * @param \Quanta\ArrayTypeCheck\ResultInterface    $result
     * @throws \InvalidArgumentException
     */
    public function __construct(string $source, ResultInterface $result)
    {
        if ($result->isValid()) {
            throw new \InvalidArgumentException(
                'Can\'t format a successful array type check result'
            );
        }

        $this->source = $source;
        $this->result = $result;
    }

    /**
     * Return a string representation of the failed array type check result.
     *
     * @return string
     */
    public function __toString()
    {
        $path = $this->result->path();

        if (count($path) > 1) {
            return vsprintf('Key %s of %s must be %s, %s given for key %s', [
                implode('', array_map([$this, 'key'], array_slice($path, 0, -1))),
                lcfirst($this->source),
                $this->result->expected(),
                $this->result->given(),
                $this->key(end($path)),
            ]);
        }

        return vsprintf('%s must be %s, %s given for key %s', [
            ucfirst($this->source),
            $this->result->expected(),
            $this->result->given(),
            $this->key($path[0]),
        ]);
    }

    private function key(string $str): string
    {
        return sprintf('[%s]', $str);
    }
}
