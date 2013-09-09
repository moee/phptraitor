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
     * @throws Exception Generic run time exception if something is wrong and
     * therefore the value cannot be set. Usually this will be the case
     * if something is not configured/initialized properly.
     * @throws \InvalidArgumentException If $value is not valid for this field.
     */
    function setValue($value); 
}