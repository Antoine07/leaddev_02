<?php

require_once __DIR__ . '/vendor/autoload.php';

// création des produits
$products = [
    'apple' => new Product(name: 'apple', price: 10.5),
    'raspberry' => new Product(name: 'raspberry', price: 13),
    'strawberry' => new Product(name: 'strawberry', price: 7.5),
    'orange' => new Product(name: 'orange', price: 7.5),
];

$storageSession =  new StorageArray;
$cart = new Cart($storageSession);

extract($products);

$cart->buy($apple, 3);
$cart->buy($apple, 4);
$cart->buy($apple, 5);
$cart->buy($strawberry, 10);
// ...

echo "\n";
echo $cart->total();
echo "\n";

// retire un produit du panier
echo "restore" . "\n";
$cart->restore($strawberry);

echo "\n";
echo $cart->total();
echo "\n";
