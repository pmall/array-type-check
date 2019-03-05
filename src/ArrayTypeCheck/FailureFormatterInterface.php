<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

interface FailureFormatterInterface
{
    /**
     * Return a failure message using the given source of the array.
     *
     * @param string $source
     * @return string
     */
    public function __invoke(string $source): string;
}
