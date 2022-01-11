<?php

namespace App\Strategy\Algorithms;

use App\Strategy\IStrategy;

class Base implements IStrategy
{

    public function __construct(private int $base)
    {
    }

    public function execute(int $number, int $initialeBase)
    {

        if(in_array($this->base, [2, 13]) || $this->base > 13 ) throw new \LogicException("Cette base n'existe pas $this->base");

        return base_convert($number, $initialeBase, $this->base);
    }
}
