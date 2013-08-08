<?php

namespace Traitor\GetSet;

interface Field
{
    function getName();
    function getValue();
    function setValue();
}
