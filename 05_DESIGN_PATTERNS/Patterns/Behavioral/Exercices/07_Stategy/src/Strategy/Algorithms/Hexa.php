<?php

namespace App\Strategy\Algorithms;

use App\Strategy\IStrategy;

class Hexa implements IStrategy
{

    public function execute(int $number, int $initialeBase)
    {
        return base_convert($number, $initialeBase, 13);
    }
}
