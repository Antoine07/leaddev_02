<?php

namespace Cart;

class StorageArray  implements Storable
{

    private $storage = []; // array

    /**
     * setValue
     *
     * @param string $name
     * @param float $total
     * @return void
     */
    public function setValue(string $name, float $value): void
    {
        if ( array_key_exists($name, $this->storage) == true ) {
            $this->storage[$name] += $value;
        } else {
            $this->storage[$name] = $value;
        }
    }

    public function reset():void{

        $this->storage = [];
    }

    public function getStorage():iterable{

        return $this->storage;
    }

    public function restore(string $name):void{
        if( array_key_exists($name, $this->storage) ){
            unset($this->storage[$name]);
        }
    }
}
