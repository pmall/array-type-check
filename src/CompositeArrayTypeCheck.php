<?php declare(strict_types=1);

namespace Quanta;

use Quanta\ArrayTypeCheck\Type;
use Quanta\ArrayTypeCheck\Success;
use Quanta\ArrayTypeCheck\ResultInterface;

final class CompositeArrayTypeCheck implements ArrayTypeCheckInterface
{
    private $checks;

    public function __construct(ArrayTypeCheckInterface ...$checks)
    {
        $this->checks = $checks;
    }

    public function checked(array $array): ResultInterface
    {
        foreach ($this->checks as $check) {
            $result = $check->checked($array);

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
