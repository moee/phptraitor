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
    
    private $name;
    
    private $fieldValue = null;
    
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
        return $this->fieldValue;
    }

    function setValue($value)
    {
        $this->fieldValue = $value;
        return $this;
    }
    
    
    
}
