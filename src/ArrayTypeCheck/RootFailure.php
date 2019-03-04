<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class RootFailure implements ResultInterface
{
    /**
     * The non array value.
     *
     * @var mixed
     */
    private $given;

    /**
     * Constructor.
     *
     * @param mixed $given
     */
    public function __construct($given)
    {
        $this->given = $given;
    }

    /**
     * @inheritdoc
     */
    public function isValid(): bool
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function given()
    {
        return gettype($this->given);
    }

    /**
     * @inheritdoc
     */
    public function expected(): string
    {
        return 'array';
    }

    /**
     * @inheritdoc
     */
    public function path(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function sanitized(): array
    {
        throw new \LogicException('The type check failed');
    }

    /**
     * @inheritdoc
     */
    public function message(): InvalidArrayMessage
    {
        return new InvalidArrayMessage($this);
    }

    /**
     * Quick fix.
     */
    public function isRoot(): bool
    {
        return true;
    }
}
