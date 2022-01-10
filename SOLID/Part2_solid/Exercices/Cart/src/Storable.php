<?php 

interface Storable{
    public function setValue(string $name, float $value): void;
    public function reset():void;
    public function getStorage():iterable;
    public function restore(string $name):void;
}