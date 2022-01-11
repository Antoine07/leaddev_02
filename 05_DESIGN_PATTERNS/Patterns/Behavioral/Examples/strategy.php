<?php

interface IStrategy {
    public function execute(string $message):string;
}

class Humain implements IStrategy{
    
    public function execute(string $message):string{

        return $message;
    }
}

class Robot implements IStrategy{
    
    public function execute(string $message):string{

        return implode( "", array_map( function($c) {return ord($c) ;},  str_split($message) ) );
    }
}

abstract class Context {
    public function __construct(protected IStrategy $strategy){
    }

    abstract public function getUse(string $message):string;
}

class A extends Context {
    
    public function getUse(string $message):string{

        return $this->strategy->execute($message);
    }
}

echo (new A(new Humain))->getUse("Hello");
print_r("\n");
echo (new A(new Robot))->getUse("Hello");
print_r("\n");