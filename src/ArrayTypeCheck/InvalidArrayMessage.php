<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class InvalidArrayMessage
{
    /**
     * The formatter to use.
     *
     * @var \Quanta\ArrayTypeCheck\FailureFormatterInterface
     */
    private $formatter;

    /**
     * Constructor.
     *
     * @param \Quanta\ArrayTypeCheck\FailureFormatterInterface $formatter
     */
    public function __construct(FailureFormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * Return a string representation of the failed array type check result.
     *
     * @return string
     */
    public function source(string $source): string
    {
        return ($this->formatter)($source);
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
    public function method(object $object, string $method, int $position): string
    {
        return $this->static(Helpers::classname($object), $method, $position);
    }

    /**
     * Return an invalid argument exception for a constructor call.
     *
     * @param object    $object
     * @param int       $position
     * @return string
     */
    public function constructor(object $object, int $position): string
    {
        return $this->method($object, '__construct', $position);
    }
}
