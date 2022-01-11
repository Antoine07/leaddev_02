<?php

class myIterator implements Iterator
{
    private $position = 0;
    private $array = [0 => "v1", 1 => "v2", 2 => "v3", 3 => "k4", 4 => "k5"];

    public function __construct()
    {

        $this->position = 0;
    }

    public function rewind(): void
    {

        $this->position = 0;
    }

    public function current()
    {
        return $this->array[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next(): void
    {
        $this->position += 2;
    }

    public function valid(): bool
    {
        return isset($this->array[$this->position]);
    }
}


$it = new myIterator;

foreach ($it as $key => $value) {
    var_dump($key, $value);
    echo "\n";
}
