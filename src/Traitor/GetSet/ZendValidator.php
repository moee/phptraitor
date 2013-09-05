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
 
    function __construct($name = null)
    {
        $this->setName($name);
    }

    function setValue($value)
    {
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
