<?php 

namespace Traitor;

/**
 * Trait that aims to make using iterators more convenient  
 * @author moe
 */
trait SmartIterator
{
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
        if (isset($this->_guard)) {
            $g = $this->_guard;
            if (!$g($element)) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Guard returns false for value %s',
                        $element
                    )
                ); 
            }
        }

        $this->array[] = $element;
        return $this;
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

    public function setGuard($guard)
    {
        if (isset($this->array) && count($this->array) > 0) {
            throw new \RuntimeException(
                'A guard cannot be set fater the first value has been added'
            );
        }

        $this->_guard = $guard;
    }

    public function toArray()
    {
        return $this->array;
    }

    public function from($from)
    {
        $this->from = $from;
        return $this;
    }

    public function to($to)
    {
        $this->array = range($this->from, $to);
        return $this;
    }

    public function count()
    {
        return count($this->array);
    }
}
