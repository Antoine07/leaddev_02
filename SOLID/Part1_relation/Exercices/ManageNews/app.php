<?php

spl_autoload_register(function ($class) {
    include __DIR__ . '/' . $class . '.php';
});

$n1 = new ManageNews(Log::class, "Article PHP");
sleep(2);
$n2 = new ManageNews(Log::class, "Article MySQL");
sleep(1);
$n3 = new ManageNews(Log::class, "Article JS");
sleep(1);
$n4 = new ManageNews(Log::class, "Article MongoDB");
sleep(1);
$n5 = new ManageNews(Log::class, "Article Python");

