<?php

class Cart
{

    private $storage = null;
    private $tva;
    const PRECISION = 2;

    public function __construct(Storable $storage, float $tva = 0.2)
    {
        $this->tva = $tva;
        $this->storage = $storage;
    }

    public function buy(Product $product, int $quantity): void
    {
        $total = $quantity * $product->getPrice() * ($this->tva + 1);

        $this->storage->setValue(name: $product->getName(), value: $total);
    }

    public function reset(): void
    {

        $this->storage->reset();
    }

    public function total(): float
    {

        $total = .0;
        foreach ($this->storage->getStorage() as $storage) $total += $storage;

        return round($total, SELF::PRECISION);
    }

    public function restore(Product $product): void
    {

        $this->storage->restore($product->getName());
    }
}
