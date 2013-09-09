<?php

namespace Traitor\GetSet\ReflectionClassLoader;

class PlainReflectionClassLoader
    implements IReflectionClassLoader
{
    function getReflectionClass($forClass)
    {
        return new \ReflectionClass($forClass);
    }
}