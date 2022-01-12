<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\HtmlDecorator\{Italic, Text, Paragraph };

echo (new Paragraph( ( new Italic(new Text("Hello world!")))->setColor('red') ) )->setClass("foo")->setClass("bar");
