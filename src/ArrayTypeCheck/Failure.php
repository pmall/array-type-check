<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class Failure implements ResultInterface
{
    /**
     * The value having an unexpected type.
     *
     * @var mixed
     */
    private $given;

    /**
     * The expected type.
     *
     * @var \Quanta\ArrayTypeCheck\TypeInterface
     */
    private $type;

    /**
     * The key of the value having an unexpected type.
     *
     * @var string
     */
    private $key;

    /**
     * Constructor.
     *
     * @param mixed                                 $given
     * @param \Quanta\ArrayTypeCheck\TypeInterface  $type
     * @param string                                $key
     */
    public function __construct($given, TypeInterface $type, string $key)
    {
        $this->given = $given;
        $this->type = $type;
        $this->key = $key;
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
        return $this->given;
    }

    /**
     * @inheritdoc
     */
    public function expected(): string
    {
        return $this->type->str();
    }

    /**
     * @inheritdoc
     */
    public function path(): array
    {
        return [$this->key];
    }

    /**
     * @inheritdoc
     */
    public function sanitized(): array
    {
        throw new \LogicException('The type check failed');
    }
}
