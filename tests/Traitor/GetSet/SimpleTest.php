<?php 

use Traitor\GetSet\Simple;
class SimpleTest
    extends PHPUnit_Framework_TestCase
 {
   // private $test = Simple::getInstance('name');
     
    public function testGetName()
    {
        $simple = new Simple('simple');
        $this->assertEquals('simple', $simple->getName());
    }
    

}
