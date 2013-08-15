<?php

namespace Traitor\GetSet;

/**
 * @Annotation
 * @author moe
 *
 */
class Simple implements Field
{
    function __construct($name = null)
    {
        $this->setName($name);
    }
    
    function setName($name)
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
