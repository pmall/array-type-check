<?php

declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class Success implements ResultInterface
{
    /**
     * @inheritdoc
     */
    public function isValid(): bool
    {
        return true;
    }
}
