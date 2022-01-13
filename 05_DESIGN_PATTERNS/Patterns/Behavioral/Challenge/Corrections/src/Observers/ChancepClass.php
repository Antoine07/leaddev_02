<?php

namespace App\Observers;

use Ds\Map;

class ChancePClass implements \SplObserver
{


    public function __construct(private Map $analyse)
    {

        $this->storage = new Map;
    }

    public function update(\SplSubject $passenger): void
    {

        [$name, $sex, $pClass] = [$passenger->getName(), $passenger->getSex(), $passenger->getPclass()];

        if ($this->storage->hasKey($name)) throw new \LogicException(sprintf('this passenger %s is already known', $name));

        if (strtolower($sex) == 'male') {
            $chance = round($this->analyse->get('survivedMale') / $this->analyse->get('total'), 2);
        }

        if (strtolower($sex) == 'female') {
            $chance = round($this->analyse->get('survivedFemale') / $this->analyse->get('total'), 2);
        }

        $this->storage->put($name, ['chance' => $chance, 'pClass' => $pClass, 'sex' => $sex]);
    }

    public function getStorage(): Map
    {

        return $this->storage;
    }
}
