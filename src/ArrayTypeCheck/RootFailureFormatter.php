<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class RootFailureFormatter implements FailureFormatterInterface
{
    /**
     * The root failure.
     *
     * @var \Quanta\ArrayTypeCheck\RootFailure
     */
    private $result;

    /**
     * Constructor.
     *
     * @param \Quanta\ArrayTypeCheck\RootFailure $result
     */
    public function __construct(RootFailure $result)
    {
        $this->result = $result;
    }

    /**
     * Return a string representation of the root failure for the given source.
     *
     * @param string $source
     * @return string
     */
    public function __invoke(string $source): string
    {
        return vsprintf('Key %s of %s must be an array, %s given', [
            Helpers::path(...$this->result->path()),
            lcfirst($source),
            Helpers::type($this->result->given()),
        ]);
    }
}
