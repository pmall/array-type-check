<?php

declare(strict_types=1);

namespace Quanta;

use Quanta\ArrayTypeCheck\{
    Success,
    Failure,
    CustomType,
    BuiltInType,
    CallableType,
    TypeInterface,
    ResultInterface
};

final class ArrayTypeCheck
{
    /**
     * The type to check.
     *
     * @var \Quanta\ArrayTypeCheck\TypeInterface
     */
    private $type;

    /**
     * Return a new array type check for the given type.
     *
     * Allow cleaner call to ::on()
     *
     * @param string $type
     * @return \Quanta\ArrayTypeCheck
     * @throws \InvalidArgumentException
     */
    public static function type(string $type): self
    {
        if ($type == 'callable') {
            return new self(new CallableType);
        }

        try {
            return new self(new BuiltInType($type));
        }

        catch (\InvalidArgumentException $e) {}

        try {
            return new self(new CustomType($type));
        }

        catch (\InvalidArgumentException $e) {}

        $tpl = implode(' ', [
            'Argument 1 passed to %s::type() is invalid,',
            'it must be either a return value of gettype(),',
            '\'callable\',',
            'an interface name or',
            'a class name',
        ]);

        throw new \InvalidArgumentException(
            sprintf($tpl, self::class)
        );
    }

    /**
     * Constructor.
     *
     * @param \Quanta\ArrayTypeCheck\TypeInterface $type
     * @throws \InvalidArgumentException
     */
    public function __construct(TypeInterface $type)
    {
        $this->type = $type;
    }

    /**
     * Return the result of type checking all the values of the given array.
     *
     * @param array $values
     * @return \Quanta\ArrayTypeCheck\ResultInterface
     */
    public function on(array $values): ResultInterface
    {
        $invalid = array_diff_key(
            $values,
            array_filter(
                array_map([$this->type, 'isAccepting'], $values)
            )
        );

        return count($invalid) > 0
            ? new Failure($this->type, (string) key($invalid), current($invalid))
            : new Success;
    }

    /**
     * Return the invalid type error message.
     *
     * @param string    $method
     * @param int       $position
     * @return string
     */
    private function invalidTypeErrorMessage(string $method, int $position): string
    {
        $tpl = implode(' ', [
            'Argument %s passed to %s::%s() is not a valid type,',
            'it must be either a return value of gettype(),',
            'the \'callable\' string,',
            'an interface name or',
            'a class name',
        ]);

        return sprintf($tpl, $position, self::class, $method);
    }
}
