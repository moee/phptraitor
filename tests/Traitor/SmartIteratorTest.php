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

    public function testMap()
    {
        $smartIterator = new SampleIterator();
        $smartIterator->add(5);
        $smartIterator->add(10);
        $smartIterator->map(function($e) { return $e * 3; });
        $this->assertEquals(array(15, 30), $smartIterator->toArray());
    }

    public function testSelect()
    {
        $smartIterator = new SampleIterator();
        $smartIterator->add(5);
        $smartIterator->add(8);
        $smartIterator->add(10);
        $result = $smartIterator->select(function($e) { return $e > 6; });
        $this->assertEquals(array(8, 10), $result->toArray());
    }

    public function testMapReturnsSelf()
    {
        $smartIterator = new SampleIterator();
        
        $this->assertEquals($smartIterator, $smartIterator->map(function($e) {}));
    }
}

class SampleIterator
    implements \Iterator 
{
    use Traitor\SmartIterator;
    
}
