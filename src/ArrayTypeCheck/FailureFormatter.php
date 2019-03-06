<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class FailureFormatter implements FailureFormatterInterface
{
    /**
     * The value with an invalid type.
     *
     * @var mixed
     */
    private $given;

    /**
     * The expected type.
     *
     * @var string
     */
    private $expected;

    /**
     * The key of the value with an invalid type.
     *
     * @var string
     */
    private $key;

    /**
     * The path of the invalid array.
     *
     * @var string[]
     */
    private $path;

    /**
     * Constructor.
     *
     * @param mixed     $given
     * @param string    $expected
     * @param string    $key
     * @param string    ...$path
     */
    public function __construct($given, string $expected, string $key, string ...$path)
    {
        $this->given = $given;
        $this->expected = $expected;
        $this->key = $key;
        $this->path = $path;
    }

    /**
     * Return a string representation of the failure for the given source.
     *
     * @param string $source
     * @return string
     */
    public function __invoke(string $source): string
    {
        if (count($this->path) == 0) {
            return vsprintf('%s must be %s, %s given for key %s', [
                ucfirst($source),
                $this->expected(),
                $this->type(),
                Utils::key($this->key),
            ]);
        }

        return vsprintf('Key %s of %s must be %s, %s given for key %s', [
            Utils::path(...$this->path),
            lcfirst($source),
            $this->expected(),
            $this->type(),
            Utils::key($this->key),
        ]);
    }

    /**
     * Return the string representation of the invalid type.
     *
     * @return string
     */
    private function type(): string
    {
        if (is_object($this->given)) {
            if (interface_exists($this->expected) || class_exists($this->expected)) {
                return sprintf('instance of %s', Utils::classname($this->given));
            }
        }

        return Utils::type($this->given);
    }

    /**
     * Return the string representation of the expected type.
     *
     * @return string
     */
    private function expected(): string
    {
        if (interface_exists($this->expected)) {
            return sprintf('an array of %s implementations', $this->expected);
        }

        if (class_exists($this->expected)) {
            return sprintf('an array of %s instances', $this->expected);
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

        return $map[$this->expected] ?? 'unknown';
    }
}
