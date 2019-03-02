<?php declare(strict_types=1);

namespace Quanta;

use Quanta\ArrayTypeCheck\Success;
use Quanta\ArrayTypeCheck\Failure;
use Quanta\ArrayTypeCheck\TypeCheck;
use Quanta\ArrayTypeCheck\RootFailure;
use Quanta\ArrayTypeCheck\ResultWithKey;
use Quanta\ArrayTypeCheck\ResultInterface;
use Quanta\ArrayTypeCheck\TypeCheckInterface;

final class ArrayTypeCheck implements ArrayTypeCheckInterface
{
    /**
     * The expected type of the array values.
     *
     * @var \Quanta\ArrayTypeCheck\TypeCheckInterface
     */
    private $type;

    /**
     * The sub keys.
     *
     * @var string[]
     */
    private $keys;

    /**
     * Return the result of validating the given array against the given type
     * and sub keys.
     *
     * @param mixed     $value
     * @param string    $type
     * @param string    ...$keys
     * @return \Quanta\ArrayTypeCheck\ResultInterface
     */
    public static function result($value, string $type, string ...$keys): ResultInterface
    {
        return (new ArrayTypeCheck(new TypeCheck($type), ...$keys))->validated($value);
    }

    /**
     * Constructor.
     *
     * @param \Quanta\ArrayTypeCheck\TypeCheckInterface $type
     * @param string                                    ...$keys
     */
    public function __construct(TypeCheckInterface $type, string ...$keys)
    {
        $this->type = $type;
        $this->keys = $keys;
    }

    /**
     * @inheritdoc
     */
    public function validated($value): ResultInterface
    {
        if (! is_array($value)) {
            return new RootFailure($value);
        }

        if (count($this->keys) == 0) {
            return count($invalid = $this->invalidKeys($value)) == 0
                ? new Success($value)
                : new Failure($value[$invalid[0]], $this->type, (string) $invalid[0]);
        }

        return $this->keys[0] == '*'
            ? $this->composite($value)
            : $this->nested($value);
    }

    /**
     * Return the keys of the given array associated to values of a different
     * type than the expected one.
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
     * Return the result of the first key type check.
     *
     * @param array $values
     * @return \Quanta\ArrayTypeCheck\ResultInterface
     */
    private function nested(array $values): ResultInterface
    {
        $key = $this->keys[0];
        $value = $values[$key] ?? [];

        $check = new ArrayTypeCheck($this->type, ...array_slice($this->keys, 1));

        return new ResultWithKey($check->validated($value), $key);
    }

    /**
     * Return the result of a composite array type check on all the keys of the
     * given array.
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
                ...array_slice($this->keys, 1)
            );
        }

        return (new CompositeArrayTypeCheck(...($checks ?? [])))->validated($values);
    }
}
