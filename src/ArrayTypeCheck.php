<?php declare(strict_types=1);

namespace Quanta;

use Quanta\ArrayTypeCheck\Type;
use Quanta\ArrayTypeCheck\Success;
use Quanta\ArrayTypeCheck\Failure;
use Quanta\ArrayTypeCheck\RootFailure;
use Quanta\ArrayTypeCheck\NestedResult;
use Quanta\ArrayTypeCheck\TypeInterface;
use Quanta\ArrayTypeCheck\ResultInterface;

final class ArrayTypeCheck implements ArrayTypeCheckInterface
{
    /**
     * The type all the array values are expected to have.
     *
     * @var \Quanta\ArrayTypeCheck\TypeInterface
     */
    private $type;

    /**
     * The key path where the array to type check is located.
     *
     * @var string[]
     */
    private $path;

    /**
     * Type check the given array against the given type.
     *
     * @param array     $array
     * @param string    $type
     * @return \Quanta\ArrayTypeCheck\ResultInterface
     */
    public static function result(array $array, string $type): ResultInterface
    {
        return (new self(new Type($type)))->checked($array);
    }

    /**
     * Type check the given key paths against their associated type.
     *
     * @param array     $array
     * @param string[]  $paths
     * @return \Quanta\ArrayTypeCheck\ResultInterface
     * @throws \InvalidArgumentException
     */
    public static function nested(array $array, array $paths): ResultInterface
    {
        $result = self::result($paths, 'string');

        if (! $result->isValid()) {
            throw new \InvalidArgumentException(
                $result->message()->static(self::class, 'nested', 2)
            );
        }

        $checks = [];

        foreach ($paths as $path => $type) {
            $checks[] = new self(new Type($type), ...explode('.', $path));
        }

        return (new CompositeArrayTypeCheck(...$checks))->checked($array);
    }

    /**
     * Constructor.
     *
     * @param \Quanta\ArrayTypeCheck\TypeInterface  $type
     * @param string                                ...$path
     */
    public function __construct(TypeInterface $type, string ...$path)
    {
        $this->type = $type;
        $this->path = $path;
    }

    /**
     * @inheritdoc
     */
    public function checked(array $array): ResultInterface
    {
        if (count($this->path) == 0) {
            return count($invalid = $this->invalidKeys($array)) == 0
                ? new Success($array)
                : new Failure($array[$invalid[0]], $this->type, (string) $invalid[0]);
        }

        $key = $this->path[0];
        $subpath = array_slice($this->path, 1);

        if ($key == '*') {
            return $this->exploded($array, ...$subpath)->checked($array);
        }

        $value = $array[$key] ?? [];

        return new NestedResult(
            ! is_array($value)
                ? new RootFailure($value)
                : (new self($this->type, ...$subpath))->checked($value),
            $key
        );
    }

    /**
     * Return the keys of the given array which are associated to a value not
     * passing the type check.
     *
     * @param array $array
     * @return (int|string)[]
     */
    private function invalidKeys(array $array): array
    {
        return array_values(
            array_diff(
                array_keys($array),
                array_keys(array_filter($array, [$this->type, 'isValid']))
            )
        );
    }

    /**
     * Return a composite type check from the given array and key path.
     *
     * @param array     $array
     * @param string    ...$path
     * @return \Quanta\CompositeArrayTypeCheck
     */
    private function exploded(array $array, string ...$path): CompositeArrayTypeCheck
    {
        $checks = [];

        foreach (array_keys($array) as $key) {
            $checks[] = new self($this->type, (string) $key, ...$path);
        }

        return new CompositeArrayTypeCheck(...$checks);
    }
}
