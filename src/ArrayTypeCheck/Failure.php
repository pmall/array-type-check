<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class Failure implements ResultInterface
{
    /**
     * The value with an invalid type.
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
     * The path of the invalid array.
     *
     * @var string[]
     */
    private $path;

    /**
     * Constructor.
     *
     * @param mixed                                 $given
     * @param \Quanta\ArrayTypeCheck\TypeInterface  $type
     * @param string                                $key
     * @param string                                ...$path
     */
    public function __construct($given, TypeInterface $type, string $key, string ...$path)
    {
        $this->given = $given;
        $this->type = $type;
        $this->key = $key;
        $this->path = $path;
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
        return array_merge($this->path, [$this->key]);
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
    public function with(string $key): ResultInterface
    {
        return new Failure($this->given, $this->type, $this->key, $key, ...$this->path);
    }

    /**
     * @inheritdoc
     */
    public function sanitized(): array
    {
        throw new \LogicException('The array is not valid');
    }

    /**
     * @inheritdoc
     */
    public function message(): InvalidArrayMessage
    {
        return new InvalidArrayMessage(
            new FailureFormatter(
                $this->given,
                $this->type->str(),
                $this->key,
                ...$this->path
            )
        );
    }
}
