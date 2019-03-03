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
     * The sub key path where the array to type check is located.
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
        return (new ArrayTypeCheck(new Type($type)))->checked($array);
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

        return $this->path[0] == '*'
            ? $this->composite($array)
            : $this->nested($array);
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
     * Type check the first key of the sub key path.
     *
     * @param array $array
     * @return \Quanta\ArrayTypeCheck\ResultInterface
     */
    private function nested(array $array): ResultInterface
    {
        $key = $this->path[0];
        $value = $array[$key] ?? [];

        if (! is_array($value)) {
            return new RootFailure($value);
        }

        $check = new ArrayTypeCheck($this->type, ...array_slice($this->path, 1));

        return new NestedResult($check->checked($value), $key);
    }

    /**
     * Return the result of a composite type checking of the given array.
     *
     * @param array $array
     * @return \Quanta\ArrayTypeCheck\ResultInterface
     */
    private function composite(array $array): ResultInterface
    {
        foreach (array_keys($array) as $key) {
            $checks[] = new ArrayTypeCheck(
                $this->type,
                (string) $key,
                ...array_slice($this->path, 1)
            );
        }

        $check = new CompositeArrayTypeCheck(...($checks ?? []));

        return $check->checked($array);
    }
}
