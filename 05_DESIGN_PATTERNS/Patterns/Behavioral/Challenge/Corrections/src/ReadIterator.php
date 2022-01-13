<?php

namespace App;

class ReadIterator implements \Iterator
{

    public function __construct(
        private string $file,
        private  $pointer = '',
        private int $rowCounter = 0,
        private string $separator = ','
    ) {

        $this->pointer = fopen($file, 'r'); // resource
    }

    public function rewind(): void
    {
        $this->rowCounter = 0;
        // remettre le pointeur au début du fichier
        rewind($this->pointer);
    }

    public function current(): array
    {
        $this->rowCounter++;
        return fgetcsv($this->pointer, 1000, $this->separator);
    }

    public function key(): int
    {
        $this->rowCounter;
    }

    public function next(): bool
    {
        return !feof($this->pointer);
    }

    public function valid(): bool
    {
        if(!is_resource($this->pointer)) return false;

        if($this->next()) return true;

        return false;
    }

    public function __destruct()
    {
        fclose($this->pointer);
    }
}
