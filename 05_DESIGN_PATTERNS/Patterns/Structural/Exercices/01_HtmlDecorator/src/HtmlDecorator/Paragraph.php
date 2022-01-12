<?php

namespace App\HtmlDecorator;

class Paragraph extends Decorator
{

    public function __toString(): string
    {
        
        $classes = $this->getClasses();

        return "<p $classes>{$this->elem->__toString()}</p>";
    }
}
