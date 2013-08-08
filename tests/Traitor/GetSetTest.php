<?php 

class GetSetTest
    extends PHPUnit_Framework_TestCase
 {
     
    /*
     * @Test 
     */
    public function testHasGetter()
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

<<<<<<< HEAD
    /**
     * @expectedException \BadMethodCallException
=======
    /*
     * @Test 
>>>>>>> 6a555f326f82ec1eb2ae6121be7262610125089d
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
}
