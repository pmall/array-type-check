<?php

declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class CallableType implements TypeInterface
{
    /**
     * @inheritdoc
     */
    public function isAccepting($value): bool
    {
        return is_callable($value);
    }

    /**
     * @inheritdoc
     */
    public function message(string $source, string $key, $value): string
    {
        return vsprintf('%s must be an array of callable values, %s given for key [%s]', [
            $source,
            new TypeStr($value),
            $key,
        ]);
    }
}
