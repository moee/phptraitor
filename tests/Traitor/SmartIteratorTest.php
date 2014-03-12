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

    public function testAddReturnsSelf()
    {
        $smartIterator = new SampleIterator();
        $this->assertEquals($smartIterator, $smartIterator->add(5));
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

    public function testGuard()
    {
        $smartIterator = new SampleIterator();
        $smartIterator->setGuard(function($e) { return is_int($e) && $e > 10; }); 
        $this->assertEquals(11, $smartIterator->add(11)->current());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGuardFails()
    {
        $smartIterator = new SampleIterator();
        $smartIterator->setGuard(function($e) { return is_int($e) && $e > 10; }); 
        $smartIterator->add(4);
    } 

    /**
     * A guard can only be set before the first value has been added.
     * @expectedException \RuntimeException
     */
    public function testGuardIsImmutable()
    {
        $smartIterator = new SampleIterator();
        $smartIterator->add(4);
        $smartIterator->setGuard(function($e) { return is_int($e) && $e > 10; }); 
    } 

    public function testFromToSemantics()
    {
        $smartIterator = new SampleIterator();
        $smartIterator->from(1)->to(100);
        $this->assertEquals(100, count($smartIterator));
    } 
}

class SampleIterator
    implements \Iterator, \Countable
{
    use Traitor\SmartIterator;
    
}
