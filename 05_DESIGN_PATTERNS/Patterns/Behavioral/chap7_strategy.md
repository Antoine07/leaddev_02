# Strategy

Il permet d'interchanger facilement des algorithmes de manière dynamique. Il permet d'appliquer un principe de la programmation objet "Encapsuler ce qui varie".

Il faut tout d'abord définir une interface pour la stratégie

```php
interface IStrategy {
    public function execute(string $message);
}
```

Les différents algorithmes implémenterons cette interface

```php

class Humain implements IStrategy{
    
    public function execute(string $message):string{
        return "$message";
    }
}

class Robot implements IStrategy{
    
    public function execute(string $message):string{
        return implode( "", array_map( function($c) {return ord($c) ;},  str_split($message) ) );
    }
}
```

Nous allons maintenant définir une classe Context abstraite, il va gérer une référence à une stratégie

```php
abstract class Context {
    public function __construct(protected IStrategy $strategy){
    }

    abstract public function getUse(string $message);
}

class A extends Context {
    
    public function getUse(string $message){
        return $this->strategy->execute($message);
    }
}

```

Maintenant changer d'algorithme est facile pour la classe A :

```php
echo (new A(new Humain))->getUse("Hello");
print_r("\n");
echo (new A(new Robot))->getUse("Hello");
print_r("\n");
```

## Exercice

En utilisant le pattern Strategy définissez trois algorithmes respectivement changement de base numérique décimale vers binaire, décimale vers hexadecimale et décimale vers une base définie en paramètre : 3, 4, ... inférieure à 13 et différente de 2.
Créez la classe Context vue précédement et testez ce pattern dans une calsse Number qui hérite du Context. 

Implémentez ce pattern dans une structure classique PHP.
