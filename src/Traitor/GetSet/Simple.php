<?php

namespace Traitor\GetSet;

/**
 * Simply set and get a value.
 * 
 * @Annotation
 * @author moe
 *
 */
class Simple implements Field
{
    private $value = null;
    
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
