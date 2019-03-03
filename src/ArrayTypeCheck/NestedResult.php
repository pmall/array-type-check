<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class NestedResult implements ResultInterface
{
    /**
     * The result.
     *
     * @var \Quanta\ArrayTypeCheck\ResultInterface
     */
    private $result;

    /**
     * The key the result is nested within.
     *
     * @var string
     */
    private $key;

    /**
     * Nest the given result within amm the given keys (for easier testing).
     *
     * @param \Quanta\ArrayTypeCheck\ResultInterface    $result
     * @param string                                    ...$keys
     */
    public static function nested(ResultInterface $result, string ...$keys): ResultInterface
    {
        if (count($keys) == 0) {
            return $result;
        }

        return NestedResult::nested(
            new NestedResult($result, (string) array_pop($keys)),
            ...$keys
        );
    }

    /**
     * Constructor.
     *
     * @param \Quanta\ArrayTypeCheck\ResultInterface    $result
     * @param string                                    $key
     */
    public function __construct(ResultInterface $result, string $key)
    {
        $this->result = $result;
        $this->key = $key;
    }

    /**
     * @inheritdoc
     */
    public function isValid(): bool
    {
        return $this->result->isValid();
    }

    /**
     * @inheritdoc
     */
    public function given()
    {
        return $this->result->given();
    }

    /**
     * @inheritdoc
     */
    public function expected(): string
    {
        return $this->result->expected();
    }

    /**
     * @inheritdoc
     */
    public function path(): array
    {
        return array_merge([$this->key], $this->result->path());
    }

    /**
     * @inheritdoc
     */
    public function sanitized(): array
    {
        return [
            $this->key => $this->result->sanitized(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function formatted(callable $formatter): string
    {
        return $formatter($this->given(), $this->expected(), ...$this->path());
    }
}
