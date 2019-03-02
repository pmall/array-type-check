<?php declare(strict_types=1);

namespace Quanta;

use Quanta\ArrayTypeCheck\Type;
use Quanta\ArrayTypeCheck\Success;
use Quanta\ArrayTypeCheck\Failure;
use Quanta\ArrayTypeCheck\RootFailure;
use Quanta\ArrayTypeCheck\ResultWithKey;
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
     * Return the result of type checking the array located at the given sub key
     * path against the given type.
     *
     * @param mixed     $value
     * @param string    $type
     * @param string    ...$path
     * @return \Quanta\ArrayTypeCheck\ResultInterface
     */
    public static function result($value, string $type, string ...$path): ResultInterface
    {
        return (new ArrayTypeCheck(new Type($type), ...$path))->checked($value);
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
    public function checked($value): ResultInterface
    {
        if (! is_array($value)) {
            return new RootFailure($value);
        }

        if (count($this->path) == 0) {
            return count($invalid = $this->invalidKeys($value)) == 0
                ? new Success($value)
                : new Failure($value[$invalid[0]], $this->type, (string) $invalid[0]);
        }

        return $this->path[0] == '*'
            ? $this->composite($value)
            : $this->nested($value);
    }

    /**
     * Return the keys of the given array which are associated to a value not
     * passing the type check.
     *
     * @param array $values
     * @return (int|string)[]
     */
    private function invalidKeys(array $values): array
    {
        return array_values(
            array_diff(
                array_keys($values),
                array_keys(array_filter($values, [$this->type, 'isValid']))
            )
        );
    }

    /**
     * Type check the first key of the sub key path.
     *
     * @param array $values
     * @return \Quanta\ArrayTypeCheck\ResultInterface
     */
    private function nested(array $values): ResultInterface
    {
        $key = $this->path[0];
        $value = $values[$key] ?? [];

        $check = new ArrayTypeCheck($this->type, ...array_slice($this->path, 1));

        return new ResultWithKey($check->checked($value), $key);
    }

    /**
     * Return the result of a composite type checking of the given array.
     *
     * @param array $values
     * @return \Quanta\ArrayTypeCheck\ResultInterface
     */
    private function composite(array $values): ResultInterface
    {
        foreach (array_keys($values) as $key) {
            $checks[] = new ArrayTypeCheck(
                $this->type,
                (string) $key,
                ...array_slice($this->path, 1)
            );
        }

        $check = new CompositeArrayTypeCheck(...($checks ?? []));

        return $check->checked($values);
    }
}
