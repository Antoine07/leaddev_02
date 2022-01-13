# Sujet Framework

Vous allez par équipe de 2 créez votre propre Framework. Ce projet doit-être documenté, vous devez fournir un README décrivant chacune de vos étapes afin de pouvoir présenter votre projet.

Dans un premier temps vous devez mettre en place la structure du Framework.

Nous utiliserons la simulation du serveur par PHP 

```php
php -S localhost:8000 -t public/
```

Attention, vous devez avoir un index.php dans le dossier public.

Vous n'êtes pas obligé de mettre une base de données en place pour ce projet.

Vous pouvez vous pouvez utiliser les composants Symfony suivants :

- Twig 

- Router

- Request 

- ...

Pour vous aidez vous pouvez utiliser la documentation de Symfony suivante qui décrit comment mettre en place un Framework PHP

[framework](https://symfony.com/doc/current/create_framework/index.html)

Vous pouvez également vous aider de ce projet personnel :

[framework](https://github.com/Antoine07/myFramwork)

## Partie 1 structure

Créez les dossiers et fichiers distincts suivants : 

```text
App/ <- l'application
    HomeController.php. <- extends Controller.php du framework
public/
    .htaccess
    index.php <-- Point d'entrée de l'application
resources/ <-- Templating
src/ <-- Structure de votre Framework
// Au nimimum vous aurez les classes métiers suivantes 
    Controller.php (Abstract controller, instanciez votre Service Container)
    Dispatcher.php
    Request.php
    Container.php
    Router.php
    ...
tests/ <-- tests
app.php <-- Bootstrap
.env <-- variables d'environnement
composer.json <-- gestion des dépendances comme Twig par exemple
```

## Partie 2 point d'entrée et bootstrap

- Le point d'entrée, ce fichier est exposé à une adresse internet

Vous devez définir un fichier .htaccess, ce fichier doit re-diriger toutes les requêtes vers le fichier index.php

```txt
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews
    </IfModule>
    RewriteBase /
    RewriteEngine On

    # Redirect Trailing Slashes...
    RewriteRule ^(.*)/$ /$1 [L,R=301]

    SetEnv APPLICATION_ENV dev

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

Le fichier index.php instanciera l'application, il incluera le fichier app.php bootstrap de l'application. Notez que le dispatcher appelle sa méthode run.

```php
/**
 * @author: 
 * @description: framework PHP
 */

require_once __DIR__.'/../app.php';

$dispatcher->run();
```

## Partie 3  Dispatcher

Notez que votre Dispatcher peut contenir votre Service Container. Dans ce cas ce dernier pourra être passer à vos contrôleurs de l'application facilement.

Définissez un abstract controller permettant de faire une instance de votre Service Container.

Il va orchestrer le demande du client et fournir une réponse au client. Il prend l'objet Request analyse la demande du client et instanciera le contrôleur et sa méthode en lui passant éventuellement des paramètres.

Le fichier app.php est le bootstrap de votre application.

```php
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

$dispatcher = new Dispatcher(new Request); // $_GET pour récupérer la demande du client 
```

Le Dispatcher possède une méthode run, c'est cette méthode qui va invoquer le router et en fonction de la route faire en sorte l'on instancie la bonne méthode dans du bon contrôleur pour répondre à la requête. Le Dispatcher possède une méthode makeController.

Notez que une fonction comme call_user_func_array permet d'appeler une méthode d'une instance en lui passant des paramètres 

```php
// $instance <=> c'est votre controller $method la méthode
call_user_func_array([$instance, $method], $params);
```

- méthode run

```php
public function run()
{
    // récupère la route à l'aide du router => nom du contrôleur + méthode avec ses paramètres éventuels

    // puis lance la méthode send() pour afficher la réponse.
}
```

- Dans la méthode makeController vous pouvez passer le Service Container.

```php
protected function makeController($controller){
    // ...
    return new $controllerClass($container);
}

```
Enfin la méthode send permet de retourner la réponse à la requête demandée. Attention cette méthode doit également gérer le statut de la réponse au client, voir les headers ci-dessous :

```php
public function send($status = '200 OK')
{
    header("HTTP/1.1 $status");
    header("Content-Type: text/html, charset=UTF-8");

    echo (string)$this; // appelle la méthode __toString et retourne la $content à envoyer au client.
}
```

## Partie 4 Twig Moteur de template

Vous pouvez mettre en place le composant Twig pour gérer les vues dans la réponse au client. Utilisez votre Service Container pour préparer Twig et son utilisation dans votre framework.

```php
$container['twig'] = $container->asShared(function ($c) {
    return new Twig( /* ... */); // voir sa configuration
});
```

## Indications

Vous pouvez utiliser le service container déjà vu en cours ci-dessous :


```php

class Container implements \ArrayAccess
{

    /**
     * @var array
     */
    protected $p = [];

    /**
     * @param mixed $k
     * @param mixed $v
     */
    public function offsetSet($k, $v)
    {
        if (isset($this->p[$k])) {
            throw new \RuntimeException(\sprintf('Cannot override frozen service "%s".', $k));
        }

        $this->p[$k] = $v;
    }

    /**
     * @param mixed $k
     * @return mixed
     */
    public function offsetGet($k)
    {

        if (!isset($this->p[$k])) {
            throw new \InvalidArgumentException(\sprintf('unknow value: %s', $k));
        }

        if (is_callable($this->p[$k])) {
            return $this->p[$k]($this);
        }

        return $this->p[$k];
    }

    /**
     * @param mixed $id
     * @return bool
     */
    public function offsetExists($id)
    {
        return isset($this->p[$id]);
    }

    /**
     * @param mixed $id
     */
    public function offsetUnset($id)
    {
        if (isset($this->p[$id])) {
            unset($this->p[$id]);
        }
    }

    /**
     * @param callable $callable
     * @return callable
     */
    public function asShared(\Closure $callable)
    {

        return function ($c) use ($callable) {
            static $o;
            if (is_null($o)) {
                $o = $callable($c);
            }
            return $o;
        };
    }
}
```
