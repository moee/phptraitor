<?php

namespace Traitor\GetSet;

class Simple implements Field
{
    function __construct($name)
    {
        $this->name = $name;
    }

    function getName()
    {
        return $this->name;
    }

    function getValue()
    {
        return $this->value;
    }

    function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
