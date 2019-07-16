<?php

declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class Success implements ResultInterface
{
    /**
     * @inheritdoc
     */
    public function isSuccess(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function isFailure(): bool
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function message(string $source): string
    {
        throw new \LogicException($this->methodCallErrorMessage());
    }

    /**
     * @inheritdoc
     */
    public function function(string $function, int $position): string
    {
        throw new \LogicException($this->methodCallErrorMessage());
    }

    /**
     * @inheritdoc
     */
    public function static(string $class, string $method, int $position): string
    {
        throw new \LogicException($this->methodCallErrorMessage());
    }

    /**
     * @inheritdoc
     */
    public function method($object, string $method, int $position): string
    {
        throw new \LogicException($this->methodCallErrorMessage());
    }

    /**
     * @inheritdoc
     */
    public function constructor($object, int $position): string
    {
        throw new \LogicException($this->methodCallErrorMessage());
    }

    /**
     * @inheritdoc
     */
    public function closure(int $position): string
    {
        throw new \LogicException($this->methodCallErrorMessage());
    }

    /**
     * Return the error message for an invalid method call.
     *
     * @return string
     */
    private function methodCallErrorMessage(): string
    {
        return 'Trying to get an error message from a successfull array type check result';
    }
}
