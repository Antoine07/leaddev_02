<?php

namespace App;

use Ds\Map;

class Analyse
{

    public function __construct(
        private Map $storage,
        private ReadIterator $data,
        private string $head = 'PassengerId'
    ) {

        $this->state($head);
    }

    public function state(string $head): Map
    {

        $total = 0;
        $totalSurvived = 0;
        $survivedMale = 0;
        $survivedFemale = 0;
        $totalMale = 0;
        $totalFemale = 0;
        $survivedFemalePclass = ['1' => 0, '2' => 0, '3' => 0];
        $survivedMalePclass = ['1' => 0, '2' => 0, '3' => 0];

        $totalFemalePclass = ['1' => 0, '2' => 0, '3' => 0];
        $totalMalePclass = ['1' => 0, '2' => 0, '3' => 0];

        foreach ($this->data as $line) {
            if ($line[0] === $head) continue;

            [, $survived, $pClass,, $sex] = $line;

            $total++;

            if ((int) $survived == 1) $totalSurvived++;

            if (strtolower($sex) == 'male') {
                $totalMale++;
                $totalMalePclass[$pClass]++;
                if ($survived == 1) {
                    $survivedMale++;
                    $survivedMalePclass[$pClass]++;
                }
            }

            if (strtolower($sex) == 'female') {
                $totalFemale++;
                $totalFemalePclass[$pClass]++;
                if ($survived == 1) {
                    $survivedFemale++;
                    $survivedFemalePclass[$pClass]++;
                }
            }
           
        }

        $this->storage->put('total', $total);
        $this->storage->put('survived', $totalSurvived);
        $this->storage->put('totalMale', $totalMale);
        $this->storage->put('totalFemale', $totalFemale);
        $this->storage->put('survivedMale', $survivedMale);
        $this->storage->put('survivedFemale', $survivedFemale);
        $this->storage->put('survivedFemalePclass', $survivedFemalePclass);
        $this->storage->put('survivedMalePclass', $survivedMalePclass);
        $this->storage->put('totalFemalePclass', $totalFemalePclass);
        $this->storage->put('totalMalePclass', $totalMalePclass);

        return $this->storage;
    }

    /**
     * Get the value of storage
     */
    public function getStorage(): Map
    {
        return $this->storage;
    }
}
