<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class Success implements ResultInterface
{
    /**
     * The type checked array.
     *
     * @var array $given
     */
    private $given;

    /**
     * Constructor.
     *
     * @param array $given
     */
    public function __construct(array $given)
    {
        $this->given = $given;
    }

    /**
     * @inheritdoc
     */
    public function isValid(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function given()
    {
        throw new \LogicException('The type check succeeded');
    }

    /**
     * @inheritdoc
     */
    public function expected(): string
    {
        throw new \LogicException('The type check succeeded');
    }

    /**
     * @inheritdoc
     */
    public function path(): array
    {
        throw new \LogicException('The type check succeeded');
    }

    /**
     * @inheritdoc
     */
    public function sanitized(): array
    {
        return $this->given;
    }

    /**
     * @inheritdoc
     */
    public function message(): InvalidArrayMessage
    {
        throw new \LogicException('The type check succeeded');
    }
}
