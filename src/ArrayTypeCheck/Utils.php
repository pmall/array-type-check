<?php declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class Utils
{
    /**
     * Format the given string as an array key.
     *
     * @param string $key
     * @return string
     */
    public static function key(string $key): string
    {
        return sprintf('[%s]', $key);
    }

    /**
     * Format the given keys as a path.
     *
     * @param string ...$keys
     * @return string
     */
    public static function path(string ...$keys): string
    {
        return implode('', array_map([Utils::class, 'key'], $keys));
    }

    /**
     * Return the class name of the given object. Handle anonymous objects class
     * names.
     *
     * @param object $object
     * @return string
     */
    public static function classname($object): string
    {
        $class = get_class($object);

        return strpos($class, 'class@anonymous') !== false
            ? 'class@anonymous'
            : $class;
    }

    /**
     * Return the type of the given value.
     *
     * 'double' => 'float'
     * 'NULL' => 'null'
     *
     * @param mixed $value
     * @return string
     */
    public static function type($value): string
    {
        $type = gettype($value);

        return $type == 'double' ? 'float' : strtolower($type);
    }
}
