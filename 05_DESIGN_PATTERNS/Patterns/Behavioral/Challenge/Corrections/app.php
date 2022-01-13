<?php

require_once __DIR__ . '/vendor/autoload.php';

// 1. La proportion de personnes qui ont survécu dans le Titanic.

use Ds\Map;
use App\Analyse;
use App\Passenger;
use App\ReadIterator;
use App\Observers\{Chance, ChancePClass};

$analyse = new Analyse(new Map(), new ReadIterator(__DIR__ . '/Data/titanic.csv'));

// print_r($analyse->getStorage());
$state = $analyse->getStorage();

/*
1. La proportion de personnes qui ont survécu dans le Titanic.
*/

echo sprintf('Proportion des survivant total sur le Titanic %s', round($state->get('survived') / $state->get('total'), 2));
echo PHP_EOL;

/*
2.1 La proportion de personnes qui ont survécu dans le Titanic sachant que l'on est une femme.
*/

echo sprintf('Proportion des survivants femmes sur la population totale: %s', round($state->get('survivedFemale') / $state->get('total'), 2));
echo PHP_EOL;

echo sprintf('Proportion des survivants femmes relativement à la pop des femmes %s', round($state->get('survivedFemale') / $state->get('totalFemale'), 2));
echo PHP_EOL;

/*
2.2 La proportion de personnes qui ont survécu dans le Titanic sachant que l'on est une homme.
*/

echo sprintf('Proportion des survivants hommes sur la population totale: %s', round($state->get('survivedMale') / $state->get('total'), 2));
echo PHP_EOL;

echo sprintf('Proportion des survivants hommes relativement à la pop des hommes %s', round($state->get('survivedMale') / $state->get('totalMale'), 2));
echo PHP_EOL;

/*
3. La proportion de personnes qui ont survécu dans le Titanic sachant que l'on est une femme ou un homme selon sa classe sur le bateau.
*/


foreach (range(1, 3) as $pClass) {
    echo "Classe {$pClass}";
    echo PHP_EOL;

    echo sprintf('Proportion des survivants hommes en %s classe par rapport à la population total: %s', $pClass, round($state->get('survivedMalePclass')[$pClass] / $state->get('total'), 2));
    echo PHP_EOL;

    echo sprintf('Proportion des survivants hommes en %s classe relativement à la population des hommes de cette classe: %s', $pClass, round($state->get('survivedMalePclass')[$pClass] / $state->get('totalMalePclass')[$pClass], 2));
    echo PHP_EOL;

    echo "--------";
    echo PHP_EOL;

    echo sprintf('Proportion des survivants femmes en %s classe par rapport à la population total: %s', $pClass, round($state->get('survivedFemalePclass')[$pClass] / $state->get('total'), 2));
    echo PHP_EOL;

    echo sprintf('Proportion des survivants femmes en %s classe relativement à la population des femmes de cette classe: %s', $pClass, round($state->get('survivedFemalePclass')[$pClass] / $state->get('totalFemalePclass')[$pClass], 2));
    echo PHP_EOL;
}

// Observer

$passenger = new Passenger();
$chance = new Chance($state);
$passenger->attach($chance);
$chancePClass = new ChancePClass($state);
$passenger->attach($chancePClass );

$passenger->setPerson(name: "Alan", sex : 'male', pClass : 1);
$passenger->setPerson(name: "Alice", sex : 'female', pClass : 1);
$passenger->setPerson(name: "Bernard", sex : 'male', pClass : 2);
$passenger->setPerson(name: "Sophie", sex : 'female', pClass : 2);
$passenger->setPerson(name: "John", sex : 'male', pClass : 3);
$passenger->setPerson(name: "Marlyn", sex : 'female', pClass : 3);