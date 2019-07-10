<?php

declare(strict_types=1);

namespace Quanta\ArrayTypeCheck;

final class ClassName
{
    /**
     * The object.
     *
     * @var object
     */
    private $object;

    /**
     * Constructor.
     *
     * @param object $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * Return a string representation of the object's class name.
     *
     * @return string
     */
    public function __toString()
    {
        $class = get_class($this->object);

        return strpos($class, 'class@anonymous') !== false
            ? 'class@anonymous'
            : $class;
    }
}
