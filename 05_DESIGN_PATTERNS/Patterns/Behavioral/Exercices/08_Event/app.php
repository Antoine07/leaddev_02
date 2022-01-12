<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\{User, FactoryPDO, EventManager, Migration};

$m = new Migration();
$pdo = FactoryPDO::buildSqlite("sqlite:" . __DIR__ . "/_data/database.db");
$m->setData($pdo);

$user = new User("sqlite:" . __DIR__ . "/_data/database.db");

$eventManager = new EventManager();

EventManager::attach('database.user.connect', function (User $user) {

    $user->setHistoryCount($user->getHistoryCount() + 1);

    $user->persist();
});

// Il se connecte
$userOne = $user->find(1);
EventManager::trigger('database.user.connect', $userOne);
EventManager::trigger('database.user.connect', $userOne);
EventManager::trigger('database.user.connect', $userOne);
EventManager::trigger('database.user.connect', $userOne);
EventManager::trigger('database.user.connect', $userOne);
EventManager::trigger('database.user.connect', $userOne);
EventManager::trigger('database.user.connect', $userOne);
EventManager::trigger('database.user.connect', $userOne);

$userVerif = $user->find(1);