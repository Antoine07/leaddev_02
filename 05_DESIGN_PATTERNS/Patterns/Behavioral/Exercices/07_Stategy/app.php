<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Strategy\Algorithms\{Base, Binary, Hexa};
use App\Number;

echo (new Number(new Base(3)))->getUse(10);
echo PHP_EOL;
echo (new Number(new Base(7)))->getUse(10);
echo PHP_EOL;
echo (new Number(new Binary))->getUse(10);
echo PHP_EOL;
echo (new Number(new Hexa))->getUse(10);
echo PHP_EOL;

try {
    echo (new Number(new Base(14)))->getUse(10);
} catch (\Throwable $e) {

    echo $e->getMessage();
    echo PHP_EOL;
}
