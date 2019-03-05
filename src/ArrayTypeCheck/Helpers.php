<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class Helpers
{
    public static function key(string $key): string
    {
        return sprintf('[%s]', $key);
    }

    public static function path(string ...$keys): string
    {
        return implode('', array_map([Helpers::class, 'key'], $keys));
    }

    public static function classname(object $object) {
        $class = get_class($object);

        return strpos($class, 'class@anonymous') !== false
            ? 'class@anonymous'
            : $class;
    }

    public static function type($value) {
        $type = gettype($value);

        return $type == 'double' ? 'float' : strtolower($type);
    }
}
