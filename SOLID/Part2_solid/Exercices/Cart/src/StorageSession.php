<?php

class StorageSession implements Storable
{

    public function __construct()
    {
        if (isset($_SESSION) == false)
            session_start();

        // initialise les sessions si elle vide on crée un tableau vide
        // pour ranger nos valeurs dans le storage
        if (empty($_SESSION['storage']))
            $_SESSION['storage'] = [];
    }

    public function setValue(string $name, float $value): void
    {
        if (array_key_exists($name, $_SESSION['storage'])) {
            $_SESSION['storage'][$name] += $value;
        } else {
            $_SESSION['storage'][$name] = $value;
        }
    }

    public function reset(): void
    {
    }

    public function getStorage():iterable
    {

        return $this->storage;
    }

    public function restore(string $name): void
    {
    }
}
