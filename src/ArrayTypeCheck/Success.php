<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class Success implements ResultInterface
{
    /**
     * The valid array.
     *
     * @var array
     */
    private $value;

    /**
     * Constructor.
     *
     * @param array $value
     */
    public function __construct(array $value)
    {
        $this->value = $value;
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
    public function with(string $key): ResultInterface
    {
        return new Success([$key => $this->value]);
    }

    /**
     * @inheritdoc
     */
    public function sanitized(): array
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public function message(): InvalidArrayMessage
    {
        throw new \LogicException('The array is valid');
    }
}
