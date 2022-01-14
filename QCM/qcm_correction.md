# QCM Design Pattern & Relation de class

## Question 01

Comment définissez-vous le Design Pattern Facade ?

Répondez en choisissant une seule et bonne réponse ci-dessous.

[] Il permet d'ajouter des notifications lors d'événements particuliers dans la vie d'un objet donné.

[] Il permet de découpler le code.

[X] Il permet de masquer de la complexité dans une application.

## Question 02

Quel Design Pattern pourrait se cacher derrière le code suivant ?

```php
echo (new A(new Humain))->getUse("Hello");
echo (new A(new Robot))->getUse("Hello");
```

Répondez en choisissant une seule et bonne réponse ci-dessous.

[ ] Observer

[ ] Facade

[ ] Decorator

[ ] Composite

[ ] Iterator

[X] Strategy


## Question 03

Quel Design Pattern pourrait se cacher derrière le code suivant ?

```php
$user = new User;
$user->attach(new Log);
$user->attach(new NewUser);
$user->create('Alan', 'alan@alan.fr');
```

Répondez en choisissant une seule et bonne réponse ci-dessous.

[X] Observer

[ ] Facade

[ ] Decorator

[ ] Composite

[ ] Iterator

[ ] Strategy

## Question 04

Quel Design Pattern pourrait se cacher derrière le code suivant ?

```php
$form = new Form(name : 'user', action : "/add");
$form->add(new Input('name', "Name", 'text'));
$form->add(new Input('description', "Description", 'text'));

$wrapper = new Wrapper(); // entoure avec un div
$wrapper->add(new Input('caption', "Caption", 'text'));
$wrapper->add(new Input('image', "Image", 'file'));

$form->add($wrapper);

echo $form . "\n";
```

Répondez en choisissant une seule et bonne réponse ci-dessous.

[ ] Observer

[ ] Facade

[ ] Decorator

[X] Composite

[ ] Iterator

[ ] Strategy

## Question 05

Quel Design Pattern pourrait se cacher derrière le code suivant ?

```php
echo (new Italic(new Paragraph(new Text("Hello world!"))));
```

Répondez en choisissant une seule et bonne réponse ci-dessous.

[ ] Observer

[ ] Facade

[X] Decorator

[ ] Composite

[ ] Iterator

## Quetions 06 (*)

Qu'affiche le code suivant ?

```php
function gen(){
    $count = 0;
    while($count < 10){
        yield ++$count;
    }
}

$gen = gen();
$sum = 0;
foreach( $gen as $num) $sum += $num;
foreach( $gen as $num) $sum += $num;
echo $sum;
```

Répondez en choisissant une seule et bonne réponse ci-dessous.

[ ] 110

[] 55

[X] 55 et Exception with message 'Cannot traverse an already closed generator'

[ ] 20


## Question 07

Quel degré de relation entre la classe A parente et la classe B enfante l'héritage définit-il ?

Répondez en choisissant une seule et bonne réponse ci-dessous.

[ ] Une relation très faible entre la classe A et la classe B.

[ ] Une relation très faible entre la classe B et la classe A.

[X] La classe B est fortement liée à la classe A.

[ ] La classe A est fortement liée à la classe B.

## Question 08

Qu'impose le mot-clé final pour une classe dans un arbre d'héritage ?

Répondez en choisissant une seule et bonne réponse ci-dessous.

[X] Il termine l'arbre d'héritage, sans possibilité de continuer l'héritage.

[ ] Il termine l'arbre d'héritage, avec la possibilité de continuer l'héritage.

[ ] Il commence l'arbre d'héritage, avec la possiblité de continuer l'héritage.

[ ] Il commence l'arbre d'héritage, sans la possiblité de continuer l'héritage.

## Question 09

Quel est le symbole pour exprimer la visibilité **private**. 

Répondez en choisissant une seule et bonne réponse ci-dessous.

[X] -

[ ] +

[ ] #

## Question 10

Quel est le symbole pour exprimer la visibilité **public**. 

Répondez en choisissant une seule et bonne réponse ci-dessous.

[ ] -

[X] +

[ ] #

## Question 11

Quel est le symbole pour exprimer la visibilité **protected**. 

Répondez en choisissant une seule et bonne réponse ci-dessous.

[ ] -

[ ] +

[X] #

## Question 12

Quel est le nom de la relation entre la classe RaspberryPi et Log ?

Répondez en choisissant une seule et bonne réponse ci-dessous.

```php
class RaspberryPi{
    
    public function __construct(Log $log){
        $log->log('START...'); 
    }
}

class Log{
    protected $status;

    public function log(string $status){
        $this->status = $status;
    }
}

```


[ ] Agrégation

[ ] Composition

[ ] Association ponctuelle

[X] Association permanente


## Question 13

Quel est le nom de la relation entre la classe RaspberryPi et Connector ?

Répondez en choisissant une seule et bonne réponse ci-dessous.

```php
class RaspberryPi{
    
    public function setConnector(Connector $c){
        $c->set(); 
    }

}

class Connector{

    public function set(){
        // 
    }
}

```


[ ] Agrégation

[ ] Composition

[X] Association ponctuelle

[ ] Association permanente


## Question 14

Quel est le nom de la relation entre la classe RaspberryPi et Sd ?

Répondez en choisissant une seule et bonne réponse ci-dessous.

```php

class RaspberryPi{
    protected $sd;
    
    public function setSd(Sd $sd){
        $this->sd=$sd;
    }
    
    public function getSd(){
        return $this->sd;
    }

}

class Sd{
    
}

```

[X] Agrégation

[ ] Composition

[ ] Association ponctuelle

[ ] Association permanente


## Question 15

Quel est le nom de la relation entre la classe RaspberryPi et Arm ?

Répondez en choisissant une seule et bonne réponse ci-dessous.

```php
class RaspberryPi{
    protected $arm;
    
    public function __construct(){
        $this->arm = new Arm;
    }
}

// micro precessor
class Arm{
}
```

[ ] Agrégation

[X] Composition

[ ] Association ponctuelle

[ ] Association permanente

## Question 16

Soit la classe A ci-dessous. Peut-on instancier cette classe dans le script courant ?

Répondez en choisissant une seule et bonne réponse ci-dessous.

```php
class A{
    
    private function __construct(){
        $this->name = "A";
    }
}
```

[ ] Oui.

[X] Non. Car le constructeur est privé

## Question 17

Soit la classe Model ci-dessous. Peut-on instancier cette classe dans le script courant ?

Répondez en choisissant une seule et bonne réponse ci-dessous.

```php
abstract class Model{
    
    public function __construct(){
        $this->name = "Model";
    }
}
```

[ ] Oui.

[X] Non. La classe est abstraite et n'est pas une classe concrète donc elle n'est pas instantiable.

## Question 18

Qu'affiche le code suivant ?

Répondez en choisissant une seule et bonne réponse ci-dessous.

```php
abstract class Model{
    
    public function __construct(){
        echo $this->tableName ?? "Anonymous" ;
    }
}

class Post extends Model{
    protected $tableName = "POST";
}

$post = new Post;
```

[ ] NULL

[ ] Anonymous

[X] POST

[ ] Une exception PHP de type InvalidArgument

