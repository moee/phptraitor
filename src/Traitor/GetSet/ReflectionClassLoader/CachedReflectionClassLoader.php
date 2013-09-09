<?php

namespace Traitor\GetSet\ReflectionClassLoader;

class CachedReflectionClassLoader
    implements IReflectionClassLoader
{
    /**
     * @var array Filled with instances of \ReflectionClass
     */
    private $_cache;
    
    /**
     * @var IReflectionClassLoader
     */
    private $_reflectionClassLoader;
    
    public function __construct(IReflectionClassLoader $reflectionClassLoader) 
    {
        $this->reflectionClassLoader = $reflectionClassLoader;
    }
    
    function getReflectionClass($forClass)
    {
        if (!isset($this->_cache[get_class($forClass)])) {
            $this->_cache[get_class($forClass)] = $this->reflectionClassLoader
                ->getReflectionClass($forClass);
        }
        return $this->_cache[get_class($forClass)];
    }
}