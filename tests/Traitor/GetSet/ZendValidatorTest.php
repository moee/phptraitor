<?php 

use Traitor\GetSet\ZendValidator;

/**
 * Unit test for {@link ZendValidator}.
 * 
 * @group unittest
 * @author moe
 */
class ZendValidatorTest
    extends PHPUnit_Framework_TestCase
 {
    
    /**
    * Tests if the the value is passed to the Zend Validator. 
    * @test
    */
    public function testValidatorIsCalled()
    {
        $valueToSet = 'valueToSet';
        
        $validator = $this->getMock('\Zend\Validator\ValidatorInterface');
        $validator->expects($this->once())
            ->method('isValid')
            ->with($valueToSet)
            ->will($this->returnValue(true));
        
        $simple = new ZendValidator('field');
        $simple->setValidator($validator);
        $simple->setValue($valueToSet);
    }
    

}
