<?php 
use Traitor\GetSet\Simple;

class SmartIteratorTest
    extends PHPUnit_Framework_TestCase
 {
     
    public function testNotValidIfNew()
    {
        $smartIterator = new SampleIterator();
        $this->assertFalse($smartIterator->valid());
    }    

    public function testIteratorIterates()
    {
        $smartIterator = new SampleIterator();
        $smartIterator->add(2);
        $smartIterator->add(4);
        $smartIterator->add(8);
        $sum = 0;
        foreach ($smartIterator as $element) {
            $sum += $element;
        }
        $this->assertEquals(14, $sum);
    }    

    public function testIteratorRewind()
    {
        $smartIterator = new SampleIterator();
        $smartIterator->add(2);
        $smartIterator->add(4);
        $smartIterator->add(8);
        $smartIterator->next()->next()->rewind();
        
        $this->assertEquals(2, $smartIterator->current());
    }    

    public function testSampleIteratorAllTrue()
    {
        $smartIterator = new SampleIterator();
        $smartIterator->add(5);
        $smartIterator->add(10);
        $smartIterator->add(15);
        $this->assertTrue($smartIterator->all(function($e) { return $e < 20; }));
    }           

    public function testSampleIteratorEmpty()
    {
        $smartIterator = new SampleIterator();
        $this->assertTrue($smartIterator->all(function($e) { return $e < 20; }));
    }           

    public function testSampleIteratorAllFalse()
    {
        $smartIterator = new SampleIterator();
        $smartIterator->add(5);
        $smartIterator->add(10);
        $smartIterator->add(15);
        $this->assertFalse($smartIterator->all(function($e) { return $e < 12; }));
    }           
}

class SampleIterator
    implements \Iterator 
{
    use Traitor\SmartIterator;
    
}
