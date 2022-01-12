<?php

namespace App\HtmlDecorator;

abstract class Decorator implements IHtml
{

    public function __construct(protected IHtml $elem, protected $classes = [])
    {
    }

    public function setClass(string $value): self
    {
        $this->classes[] = $value;

        return $this;
    }

    public function getClasses():string{

        return sprintf('class="%s"', implode(' ', $this->classes));
    }
}
