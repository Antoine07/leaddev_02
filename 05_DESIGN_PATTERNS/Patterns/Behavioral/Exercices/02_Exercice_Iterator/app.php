<?php

require_once __DIR__ . '/vendor/autoload.php';

use Ds\Map;

use App\ReadIterator;
use App\Model\Person;

$relationships = new ReadIterator(__DIR__ . '/Data/relationships.txt');
$populations = new ReadIterator(__DIR__ . '/Data/populations.txt');

$storage = new Map();
$total = 0;

foreach ($populations as [$id, $name]) {
    $person = new Person(name: $name, id: $id, relations: []);
    $storage->put((int) $id, $person);
    $total += 1;
}

foreach ($relationships as [$i, $j]) {
    $storage->get((int) $i)->addRelation($storage->get((int) $j));
    $storage->get((int) $j)->addRelation($storage->get((int) $i));
}

$avg_relation = round($storage->reduce(function ($acc, $i, $pop) {
    return $acc + count($pop->getRelations());
}) / $total, 2);
