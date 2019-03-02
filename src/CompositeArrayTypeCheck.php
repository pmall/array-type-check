<?php declare(strict_types=1);

namespace Quanta;

use Quanta\ArrayTypeCheck\Success;
use Quanta\ArrayTypeCheck\TypeCheck;
use Quanta\ArrayTypeCheck\ResultInterface;

final class CompositeArrayTypeCheck implements ArrayTypeCheckInterface
{
    private $checks;

    public static function result($value, array $schema): ResultInterface
    {
        foreach ($schema as $path => $type) {
            $checks[] = new ArrayTypeCheck(new TypeCheck($type), ...explode('.', $path));
        }

        return (new CompositeArrayTypeCheck(...($checks ?? [])))->validated($value);
    }

    public function __construct(ArrayTypeCheckInterface ...$checks)
    {
        $this->checks = $checks;
    }

    public function validated($value): ResultInterface
    {
        foreach ($this->checks as $check) {
            $result = $check->validated($value);

            if (! $result->isValid()) {
                return $result;
            }

            $results[] = $result;
        }

        return new Success(
            array_merge_recursive([], ...(array_map(function ($result) {
                return $result->sanitized();
            }, $results ?? [])))
        );
    }
}
