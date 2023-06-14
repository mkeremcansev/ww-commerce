<?php

namespace App\Helpers;

use ReflectionClass;
use ReflectionException;

class EnumerationHelper
{
    /**
     * @return int[]|string[]
     *
     * @throws ReflectionException
     */
    public static function enumerationToArray($enumeration): array
    {
        $reflectionClass = new ReflectionClass($enumeration);
        $constants = $reflectionClass->getConstants();

        return array_combine(array_values($constants), array_keys($constants));
    }
}
