<?php

namespace Traitor\GetSet;

/**
 * A field that is expanded by a virtual getter and setter.
 * 
 * @author moe
 */
interface Field
{
    /**
     * The field's name
     * @param String $name
     */
    function setName($name);
    
    /**
     * @return String
     */
    function getName();
    
    /**
     * The field's current value.
     */
    function getValue();
    
    /**
     * @param mixed $value The value to set
     */
    function setValue($value); 
}