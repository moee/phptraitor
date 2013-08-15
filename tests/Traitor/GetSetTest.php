<?php 
use Traitor\GetSet\Simple;

class GetSetTest
    extends PHPUnit_Framework_TestCase
 {
     
    /*
     * @Test 
     */
    public function testHasGetter()
    {
        $getSet = $this->getObjectForTrait('Traitor\GetSet');
        return;
        $field = $this->getMock('Traitor\GetSet\Field');
        $field->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('hello'));
        $field->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue('hello'));
        $getSet->expects($this->any())
            ->method('getFields')
            ->will($this->returnValue($field));
        
        
        $this->assertEquals("hello", $getSet->getHello());
    }

    /*
     * @Test 
     */
    public function testHasSetter()
    {
        $getSet = $this->getObjectForTrait('Traitor\GetSet');
        $field = $this->getMock('Traitor\GetSet\Field');
        $field->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('hello'));
        $field->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue('hello'));
        
        $getSet->addField($field);
         
        $getSet->setHello('hello');
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testCallGibberish()
    {
        $getSet = $this->getObjectForTrait('Traitor\GetSet');
        $field = $this->getMock('Traitor\GetSet\Field');
        $field->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('hello'));
        $field->expects($this->any())
            ->method('getValue')
            ->will($this->returnValue('hello'));
        
        $getSet->f();
    }
    
    public function testAnnotationSetter()
    {
        $testObject = new GetSetClass();
        $testObject->setName('name');
    }
    
    public function testAnnotationGetter()
    {
        $testObject = new GetSetClass();
        $testObject->setName('name2');
        $this->assertEquals('name2', $testObject->getName());
    }
}



class GetSetClass {
    use Traitor\GetSet;
    
    /**
     * @Simple
     */
    private $name;
}
