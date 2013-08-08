<?php 

namespace Traitor;

use Traitor\GetSet\Field;

trait GetSet {
    private $fields = array();
    
    function __call($method, $value)
    {
        $action = substr($method, 0, 3);
        $value = lcfirst(substr($method, 3));
        foreach ($this->fields as $field) {
            if ($field->getName() == $value) {
                if ($action == 'set') {
                $field->setValue($value);            
                    return $this;
                } elseif ($action == 'get') {
                    return $field->getValue();
                }
            } 
        }
<<<<<<< HEAD
        throw new \BadMethodCallException("Method " . $method . " does not exist");
=======
        throw new \Exception("Method $method value not found");
>>>>>>> 6a555f326f82ec1eb2ae6121be7262610125089d
    }
    
    function getReturnType()
    {
        return "hello";
    }
    
    function getReturnDescription() {
        
    }
    
    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }
}
