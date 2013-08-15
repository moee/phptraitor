<?php

namespace Traitor\GetSet;

interface Field
{
    function setName($name);
    function getName();
    function getValue();
    function setValue($value); 
}
