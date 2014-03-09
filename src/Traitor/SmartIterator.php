<?php 

namespace Traitor;

/**
 * Trait that aims to make using iterators more convenient  
 * @author moe
 */
trait SmartIterator {
    
    public function rewind()
    {
        $this->getPosition();
        $this->position = 0;
        return $this;
    }

    public function current()
    {
        return $this->array[$this->getPosition()];
    }

    public function key()
    {
        return $this->getPosition();
    }

    public function next()
    {
        $this->position = $this->getPosition();
        ++$this->position;
        return $this;
    }

    public function valid()
    {
        return isset($this->array[$this->getPosition()]);
    }

    public function add($element)
    {
        $this->array[] = $element;
    }

    private function getPosition()
    {
        if (!isset($this->position)) {
            $this->position = 0;
        }

        return $this->position;
    }
    
    /**
     * Tests if for each element $e in $this $lamdba($e)
     * returns true
     */
    public function all($lambda)
    {
        foreach ($this as $e) {
            if (!$lambda($e)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Tests if there exists some element $e in $this
     * such that $lamdba($e) returns true
     */
    public function any($lambda)
    {
        foreach ($this as $e) {
            if ($lambda($e)) {
                return true;
            }
        }
        return false;
    }

    /**
     * applies the return value of $lambda to each
     * element of the iterator.
     **/
    public function map($lambda)
    {  
        foreach ($this as $k=>$e) {
            $this->array[$k] = $lambda($e);
        }
        return $this;
    }

    public function clear()
    {
        $this->array = array();
        $this->rewind();
    }

    public function select($lambda)
    {
        $result = clone $this; 
        $result->clear();
        
        foreach ($this as $e) {
            if ($lambda($e)) {
                $result->add($e);
            }
        }

        return $result;
    }

    public function toArray()
    {
        return $this->array;
    }
}
