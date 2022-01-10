# Sujet Cart

Vous allez maintenant faire un exercice de synthèse sur les concepts SOLID que nous avons abordé.
 
Vous devez appliquer les principes S.O.L.I.D.

Utilisez composer pour l'autoloader. Toutes les classes du projet seront placées dans un dossier src/. 

```text
src/
    Cart.php
    Storable.php
    Productable.php
    Product.php
    StorageArray.php
    StorageSession.php 
app.php
composer.json
```

Dans le fichier **composer.json** vous devez configurer votre autoload comme suit :

```json
"autoload": {
    "psr-4": {
        "": "src/"
    }
}
```

Identifiez bien chaque entité dans le projet en utilsant le diagramme de classe ci-après.

Deux systèmes de persistance seront testés : un StorageArray ou StorageSession.

Le panier est un panier d'un magazin bio vendant des fruits, créez
quelques produits pour tester vos méthodes.

Aidez vous également du code ci-dessous pour créer ce panier.

- Diagramme de classe

![cart](images/cart.png)

- Exemple d'utilisation du code

```php

require_once __DIR__ . '/vendor/autoload.php';

// création des produits
$products = [
    'apple' => new Product('apple', 10.5),
    'raspberry' => new Product('raspberry', 13),
    'strawberry' => new Product('strawberry', 7.5),
    'orange' => new Product('orange', 7.5),
];

$storageSession =  new StorageSession; // persistance en Session
$storageArray =  new storageArray; // utilisation pour les tests
$storageDB =  new StorageDB; // persistance en DB
$storageFile =  new StorageFile; // persistance dans un fichier

// $cart = new Cart($storageSession);

$cart = new Cart($storageArray);

extract($products);

$cart->buy($apple, 3);
$cart->buy($apple, 4);
$cart->buy($apple, 5);
$cart->buy($strawberry, 10);

echo "\n";
echo $cart->total() ; // 241.2
echo "\n";

// retire un produit du panier
echo "restore" . "\n";
$cart->restore($strawberry);

echo "\n";
echo $cart->total() ; // 151.2
echo "\n";
```