<?php

namespace App\HtmlDecorator;

class Italic extends Decorator {

    protected $style = '';

    public function setColor(string $color):self
    {
        $this->style = "style={ color : \"$color\" }";

        return $this;
    }

    public function __toString(): string
    {
        return "<em {$this->style} >{$this->elem->__toString()}</em>";
    }
}