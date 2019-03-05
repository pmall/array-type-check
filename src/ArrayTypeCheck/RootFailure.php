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
     * The key of the non array value.
     *
     * @var string $key
     */
    private $key;

    /**
     * The path of the non array value.
     *
     * @var string[]
     */
    private $path;

    /**
     * Constructor.
     *
     * @param mixed     $given
     * @param string    $key
     * @param string    ...$path
     */
    public function __construct($given, string $key, string ...$path)
    {
        $this->given = $given;
        $this->key = $key;
        $this->path = $path;
    }

    /**
     * Return the non array value.
     *
     * @return mixed
     */
    public function given()
    {
        return $this->given;
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
        return new RootFailure($this->given, $this->key, $key, ...$this->path);
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
            new RootFailureFormatter($this)
        );
    }
}
