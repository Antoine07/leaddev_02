<?php

namespace Cart;

use LogicException;
use SplSubject;
use SplObserver;
use SplObjectStorage;

class Cart implements SplSubject
{
    private $storage;
    private $tva;
    private SplObjectStorage $observers;

    public function __construct(Storable $storage, float $tva = 0.2)
    {
        $this->tva = $tva;
        $this->storage = $storage;

        $this->observers = new SplObjectStorage();
    }

    public function buy(Product $product, int $quantity): void
    {
        $total = $quantity * $product->getPrice() * ($this->tva + 1);
        $this->storage->setValue($product->getName(),$total);

        $this->notify();
    }

    public function reset(): void
    {
        $this->storage = [];

        $this->notify();
    }

    public function total(): float
    {
        return array_sum($this->storage);
    }

    public function restore(Product $product): void
    {
        if (isset($this->storage->setValue($product->getName()) ){
            unset($this->storage[$product->getName()]);

            $this->notify();
        }
    }

    public function attach(SplObserver $observer):void
    {
        $this->observers->attach($observer); // SplObjectStorage
    }

    public function detach(SplObserver $observer):void
    {
        if ($this->observers->contains($observer))
            $this->observers->detach($observer);
    }

    public function notify():void
    {
        if ($this->observers->count() === 0)
            throw new LogicException("Zero Observer ...");

        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
