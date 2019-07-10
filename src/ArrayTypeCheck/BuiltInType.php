<?php

declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class BuiltInType implements TypeInterface
{
    /**
     * Map associating allowed types to actual gettype() values.
     *
     * @var string[]
     */
    const ALLOWED = [
        'bool' => 'boolean',
        'boolean' => 'boolean',
        'int' => 'integer',
        'integer' => 'integer',
        'float' => 'double',
        'double' => 'double',
        'string' => 'string',
        'array' => 'array',
        'object' => 'object',
        'resource' => 'resource',
        'null' => 'null',
        'NULL' => 'null',
    ];

    /**
     * The type value.
     *
     * @var string
     */
    private $value;

    /**
     * Constructor.
     *
     * @param string $value
     * @throws \InvalidArgumentException
     */
    public function __construct(string $value)
    {
        if (! key_exists($value, self::ALLOWED)) {
            throw new \InvalidArgumentException(
                sprintf('Argument 1 of %s::__construct() must be a return value of gettype()', self::class)
            );
        }

        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    public function isAccepting($value): bool
    {
        return self::ALLOWED[$this->value] == strtolower(gettype($value));
    }

    /**
     * @inheritdoc
     */
    public function message(string $source, string $key, $value): string
    {
        $type2str = [
            'boolean' => 'booleans',
            'integer' => 'integers',
            'double' => 'floats',
            'string' => 'strings',
            'array' => 'arrays',
            'object' => 'objects',
            'resource' => 'resources',
            'null' => 'null values',
        ];

        return vsprintf('%s must be an array of %s, %s given for key [%s]', [
            $source,
            $type2str[self::ALLOWED[$this->value]] ?? 'unknown',
            new TypeStr($value),
            $key,
        ]);
    }
}
