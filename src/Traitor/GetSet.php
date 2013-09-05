<?php 

namespace Traitor;

use Traitor\GetSet\Field;

use Doctrine\Common\Annotations\SimpleAnnotationReader;
use Doctrine\Common\Annotations\AnnotationReader;

/**
 * This trait extends (private) fields of a class that are annoted with
 * an implementation of {@link Field} by a virtual getter and setter.
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
    
    function __call($method, $value)
    {
        $this->loadAnnotations();
        
        $phpParser = new AnnotationReader();
        
        $class = new \ReflectionClass($this);
        
        foreach ($class->getProperties() as $property) {
            foreach ($phpParser->getPropertyAnnotations($property) as $annotation) {
                if ($annotation instanceof Field) {
                    $annotation->setName($property->getName());
                    $this->fields[] = $annotation;
                }
            }
        }
        
        $action = substr($method, 0, 3);
        $name = lcfirst(substr($method, 3));
        foreach ($this->fields as $field) {
            if ($field->getName() == $name) {
                if ($action == 'set') {
                    $field->setValue($value[0]);
                    $found = true;
                } elseif ($action == 'get') {
                    return $field->getValue();
                }
            } 
        }
        
        if (@$found) {
            return true;
            
        }
        throw new \BadMethodCallException("Method " . $method . " does not exist");
    }

    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }
    
    private function loadAnnotations()
    {
        //TODO Without this the Annotation Parser fails to autoload
        // the class and I'm not sure why ...
        foreach ($this->annotations as $annotation) {
            new $annotation(array());
        } 
    }
}
