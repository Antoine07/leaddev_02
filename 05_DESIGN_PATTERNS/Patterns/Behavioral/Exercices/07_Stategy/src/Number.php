<?php

namespace App;

use App\Strategy\Context;

class Number extends Context
{

    public function getUse(int $number, int $initialeBase = 10)
    {
        return $this->strategy->execute($number, $initialeBase);
    }
}
