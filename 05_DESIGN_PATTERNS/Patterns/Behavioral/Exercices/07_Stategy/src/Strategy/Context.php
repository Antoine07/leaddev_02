<?php

namespace App\Strategy;

abstract class Context {

    public function __construct(protected IStrategy $strategy){}

    abstract public function getUse(int $number, int $initileBase);
}