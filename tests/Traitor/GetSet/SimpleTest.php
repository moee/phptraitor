<?php 

use Traitor\GetSet\Simple;
class SimpleTest
    extends PHPUnit_Framework_TestCase
 {
    public function testGetName()
    {
        $simple = new Simple();
        $simple->setName('simple');
        $this->assertEquals('simple', $simple->getName());
    }
    
    public function testGetValueIsNullIfNotSetName()
    {
        $simple = new Simple();
        $this->assertNull($simple->getValue());
    }
    

}
