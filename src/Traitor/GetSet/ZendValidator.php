<?php

namespace Traitor\GetSet;

/**
 * A field that checks the input with a
 * <a href="http://framework.zend.com/manual/2.0/en/modules/zend.validator.html">Zend Validator</a>.

 * @Annotation
 * @author moe
 *
 */
class ZendValidator extends Simple implements Field
{
    /**
     * @var \Zend\Validator\ValidatorInterface
     */
    private $validator = null; 
    
    /**
     * @var string This is the value that is received from the annotation.
     * This can be a bit confusing because it has nothing to do with the
     * value that is set in {@link #setValue($value)}.
     */
    public $value;
    
    /**
     * @var array Contains the options for the Zend Validate object.
     */
    public $options = array();
    
    function setValue($value)
    {
        if ($this->value !== null) {
            $className = sprintf('\Zend\Validator\%s', $this->value);
            $this->validator = new $className($this->options);
        }
        
        if ($this->validator === null) {
            throw new Exception('No validator has been set.');
        }
        
        if (!$this->validator->isValid($value)) {
            throw new \InvalidArgumentException(
                implode("\n", $this->validator->getMessages())
            );
        }
        
        parent::setValue($value);
        return $this;
    }
    
    public function setValidator(\Zend\Validator\ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }
}
