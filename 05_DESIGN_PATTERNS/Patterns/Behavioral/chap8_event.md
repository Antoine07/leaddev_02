# Event Listener

En JS le pattern Event est très utilisé. Il sert à définir des actions qui seront lancées lors d'un événement particulier. On le trouve également en PHP dans certains framework comme Laravel ou Symfony.

Nous allons un peu simplifier l'approche de ce design pattern afin de le découvrir. 

Sachez cependant, qu'il existe une normalisation des comportements et Design Patterns se trouvant dans la documentation PSR officiel, vous y trouverez une normalisation concernant EventDispatcher semilaire à notre Event Listener.

- [psr](https://www.php-fig.org/psr/)

Voici un exemple simple de EventManager (gestionnaire d'événements). On attache des événements que l'on déclenchera le moment souhaité dans le code :


```php

class EventManager{

    public static array $events = [];

    public static function trigger(string $event, array $argv = []){

        if(isset(self::$events[$event])){
            foreach(self::$events[$event] as $callback ) $callback($argv);
        }

        return null;
    }

     public static function attach(string $event, Closure $callback):void{
         self::$events[$event][] = $callback;
     }
}

```

Une fois que l'on a défini les événements dans la classe EventManager, on pourra dans le code de notre application les déclencher (appel des fonctions de callback). On sépare totalement la définition des actions de leurs déclenchements.


```php

EventManager::attach( event : 'database.user.create', function($args){
    $id = $args['id'];
    echo "create new user id : $id";
});

EventManager::attach( event : 'database.user.create', function($args){
    $id = $args['id'];
    echo "create last user id : $id";
});

EventManager::attach( event : 'database.user.update', function($args){
    $id = $args['id'];
    echo "create new update id : $id";
});

EventManager::trigger(event: 'database.user.create', ['id' => 1]);
EventManager::trigger(event: 'database.user.update', ['id' => 1]);
```

La PSR (PHP Standard Recommendation) possède des interfaces pour définir EventDispatcher, nous ne les utiliserons pas dans ce contexte pour cet exercice en particulier.

## 08 Exercice Event

Nous allons mettre ce pattern (Event Listener) en place à partir d'une liste d'utilisateurs existants. Nous déclencherons une action lorsque l'un d'entre eux se connectera à notre application : enregistrement dans le champ de la table users **history_count** du nombre total de ses connexions à l'application. Nous ne comptabiliserons pas les déconnexions. Ainsi si un utilisateur s'est connecté et déconnecté 10 fois à la suite, nous aurons dans le champ history_count le son nombre de connexions.

Dans la suite nous n'aborderons pas la notion de "StopPropagation" de nos événements.

### Partie 1 mise en place

- Pour les données de l'exercice utiliser la classe Migration.php ci-après.

Installez la dépendance suivante avant dans votre projet.

```bash
composer require fakerphp/faker
```

Classe Migration, utilisez pour la persistance des données SQLite.

```php

class Migration
{

    public function setData($pdo): void
    {
        $faker = Faker\Factory::create();

        $sql = "
            DROP TABLE IF EXISTS users;
        ";

        $pdo->exec($sql);
        /**
         * @create table users
         */
        $sql = "
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT,
                password TEXT,
                address TEXT,
                history_count SMALLINT UNSIGNED NOT NULL DEFAULT 0
            );
      ";

        $pdo->exec($sql);

        for ($i = 0; $i < 30; $i++) {
            $email = $faker->unique()->email;
            $pass = sha1("secret");
            $address = "Paris";
            $pdo->exec("INSERT INTO users (email, password, address) VALUES ('$email', '$pass', '$address')");
        }
    }
}
```

Vous pouvez également utiliser la classe Factory suivante pour vous connectez à la base de données.

```php

class FactoryPDO
{
    private static $pdo = null;

    private static $defaults = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];

    public static function build(string $dsn, string $username, string $password):\PDO{

        self::$pdo = new \PDO($dsn,
            $username, $password,
            self::$defaults
        );

        return self::$pdo;
    }

    public static function buildSqlite(string $dsn):\PDO{
        
         return self::$pdo = new \PDO($dsn);
    }

    public static function reset():void{ self::$pdo = null ;}
}

```

Pour se connecter à la base de données pour gérer la persistance voyez l'exemple qui suit.

```php
// pour se connecter à la base de données, dans ce cas SQLite crée automatiquement 
 $pdo = FactoryPDO::buildSqlite("sqlite:" . __DIR__ . "/_data/database.db");
```

La structure du projet sera classique, dossier src namespace etc,


Créez une classe User elle utilisera une instance de PDO pour persister les données. Voyez les features de cette classe ci-desous :

- La méthode **find** récupère un objet de type User en fonction de son identifiant champ id dans la table. Elle est auto-hydrater par la méthode fetchObjet de PDO.

```php
// permet d'hydrater (auto-hydrater) la classe User avec ses méthodes protected :
/**
protected $id;
protected $email;
protected $history_count;
protected $dsn ;
*/
$prepare->fetchObject(User::class, [$this->dsn]);
```

- La méthode all retourne l'ensemble des users dans un tableau sous forme d'objet de type User.

```php
$prepare->fetchAll(\PDO::FETCH_CLASS);
```

### Partie 2 création de la méthode persist

Créez la méthode persit elle permettra de faire persister l'historique lorsque nous déclencherons les triggers.

### Partie 3 EventManager

Créez un EventManager pour ce projet
