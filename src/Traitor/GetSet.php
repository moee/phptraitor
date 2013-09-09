<?php 

namespace Traitor;

use Traitor\GetSet\ReflectionClassLoader\CachedReflectionClassLoader;
use Traitor\GetSet\Field;
use Traitor\GetSet\ReflectionClassLoader\IReflectionClassLoader;
use Traitor\GetSet\ReflectionClassLoader\PlainReflectionClassLoader;

use Doctrine\Common\Annotations\SimpleAnnotationReader;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\ArrayCache;



/**
 * This trait extends (private) fields of a class that are annoted with
 * an implementation of {@link Field} by a virtual getter and setter.
 * 
 * @author moe
 *
 */
trait GetSet {
    
    /**
     * List of available annotations.
     * @var array
     */
    private $annotations = array(
        '\Traitor\GetSet\Simple',
        '\Traitor\GetSet\ZendValidator'
    );
    
    private $fields = array();
    
    /**
     * @var IReflectionClassLoader
     */
    private $reflectionClassLoader; 
    
    /**
     * @var AnnotationReader
     */
    private $annotationReader;
    
    private $annotationsLoaded = false;
    
    function __call($method, $value)
    {
        $this->loadAnnotations();
        
        $action = substr($method, 0, 3);
        $name = lcfirst(substr($method, 3));
        
        if (!isset($this->fields[$name])) {
            throw new \BadMethodCallException("Method " . $method . " does not exist");
        }
        
        foreach ($this->fields as $field) {
            foreach($field as $annotation) {
                if ($annotation->getName() == $name) {
                    if ($action == 'set') {
                        $annotation->setValue($value[0]);
                    } elseif ($action == 'get') {
                        return $annotation->getValue();
                    }
                } 
            }
        }
    }

    public function addField(Field $field)
    {
        if (!isset($this->fields[$field->getName()])) {
            $this->fields[$field->getName()] = array();
        }
        $this->fields[$field->getName()][] = $field;
    }
    
    private function loadAnnotations()
    {
        // Parsing the annotations is very expensive.
        // Therefore make sure it is only done once.
        if ($this->annotationsLoaded) {
            return;
        }
        
        //TODO Without this the Annotation Parser fails to autoload
        // the class and I'm not sure why ...
        foreach ($this->annotations as $annotation) {
            new $annotation(array());
        } 
        
        $class = $this->getReflectionClassLoader()->getReflectionClass($this);
        
        foreach ($class->getProperties() as $property) {
            $annotations = $this->getAnnotationReader()
            ->getPropertyAnnotations($property);
        
            foreach ($annotations as $annotation) {
                if ($annotation instanceof Field) {
                    $annotation->setName($property->getName());
                    $this->addField($annotation);
                }
            }
        }
        
        $this->annotationsLoaded= true;
    }
    
    /**
     * @return IReflectionClassLoader 
     */
    private function getReflectionClassLoader()
    {
        if ($this->reflectionClassLoader == null) {
            $this->reflectionClassLoader = new CachedReflectionClassLoader(
                new PlainReflectionClassLoader()
            );
        }
        
        return $this->reflectionClassLoader;
    }
    
    private function getAnnotationReader()
    {
        if ($this->annotationReader == null) {
            $this->annotationReader = new CachedReader(
                new AnnotationReader(),
                new ArrayCache()
            );
        }
        
        return $this->annotationReader;
    }
}
