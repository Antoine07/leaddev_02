<?php

namespace App;

class Passenger implements \SplSubject
{

    private string $name;
    private string $sex;
    private string $pClass;

    public function __construct()
    {

        $this->observers = new \SplObjectStorage();
    }

    public function setPerson(string $name, string $sex, int $pClass)
    {
        $this->name = $name;
        $this->sex = $sex;
        $this->pClass = $pClass;

        $this->notify();
    }

    public function attach(\SplObserver $observer): void
    {
        $this->observers->attach($observer); // SplObjectStorage
    }

    public function detach(\SplObserver $observer): void
    {
        if ($this->observers->contains($observer))
            $this->observers->detach($observer);
    }

    public function notify(): void
    {
        if ($this->observers->count() === 0)
            throw new \LogicException("Zero Observer ...");

        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * Get the value of name
     */ 
    public function getName():string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name):self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of sex
     */ 
    public function getSex():string
    {
        return $this->sex;
    }

    /**
     * Set the value of sex
     *
     * @return  self
     */ 
    public function setSex($sex):self
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get the value of pClass
     */ 
    public function getPClass():int
    {
        return $this->pClass;
    }

    /**
     * Set the value of pClass
     *
     * @return  self
     */ 
    public function setPClass($pClass):self
    {
        $this->pClass = $pClass;

        return $this;
    }
}
