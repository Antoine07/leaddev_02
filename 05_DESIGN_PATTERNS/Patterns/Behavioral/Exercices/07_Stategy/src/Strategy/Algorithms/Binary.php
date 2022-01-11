<?php

namespace App\Strategy\Algorithms;

use App\Strategy\IStrategy;

class Binary implements IStrategy{

    public function execute(int $number, int $initialeBase){
        return base_convert($number, $initialeBase, 2);
    }
}