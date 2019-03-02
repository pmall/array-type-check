<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class ResultWithKey implements ResultInterface
{
    private $result;

    private $key;

    public static function nested(ResultInterface $result, string ...$keys): ResultInterface
    {
        if (count($keys) == 0) {
            return $result;
        }

        return ResultWithKey::nested(
            new ResultWithKey($result, (string) array_pop($keys)),
            ...$keys
        );
    }

    public function __construct(ResultInterface $result, string $key)
    {
        $this->result = $result;
        $this->key = $key;
    }

    public function isValid(): bool
    {
        return $this->result->isValid();
    }

    public function given()
    {
        return $this->result->given();
    }

    public function expected(): string
    {
        return $this->result->expected();
    }

    public function path(): array
    {
        return array_merge([$this->key], $this->result->path());
    }

    public function sanitized(): array
    {
        return [
            $this->key => $this->result->sanitized(),
        ];
    }
}
