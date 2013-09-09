<?php 

namespace Traitor;

use Traitor\GetSet\Field;
use Traitor\GetSet\Simple;
use Doctrine\Common\Annotations\SimpleAnnotationReader;
use Doctrine\Common\Annotations\AnnotationReader;

/**
 * This trait extends (private) fields of a class that are annoted with
 * an implementation of {@link Field} by a virtual getter and setter.
 * @author moe
 *
 */
trait GetSet {
    private $fields = array();
    
    function __call($method, $value)
    {
        //TODO Without this the Annotation Parser fails to autoload
        // the class and I'm not sure why ...
        $simple = new Simple();
        
        $phpParser = new AnnotationReader();
        
        $class = new \ReflectionClass($this);
        
        foreach ($class->getProperties() as $property) {
            foreach ($phpParser->getPropertyAnnotations($property) as $annotation) {
                if ($annotation instanceof Field) {
                    $annotation->setName($property->getName());
                    if (!isset($this->fields[$property->getName()])) {
                        $this->fields[$property->getName()] = array();
                    }
                    $this->fields[$property->getName()][] = $annotation;
                }
            }
        }
        
        $action = substr($method, 0, 3);
        $name = lcfirst(substr($method, 3));
        foreach ($this->fields as $field) {
            foreach($field as $annotation) {
            if ($annotation->getName() == $name) {
                if ($action == 'set') {
<<<<<<< Updated upstream
                    $field->setValue($value[0]);
                    return $this;
=======
                    $annotation->setValue($value[0]);
                    $found = true;
>>>>>>> Stashed changes
                } elseif ($action == 'get') {
                    return $annotation->getValue();
                }
            } 
            }
        }
        throw new \BadMethodCallException("Method " . $method . " does not exist");
    }

    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }
}
