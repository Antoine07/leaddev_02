<?php

interface HtmlElement
{
    public function __toString();
    public function getName();
}

// Ce n'est pas un décorateur c'est une classe qui sera décorée par les décorateurs
class Input implements HtmlElement
{
    public function __construct(protected string $name, protected string $type)
    {
    }

    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return "<input type=\"text\" id=\"{$this->name}\" name=\"{$this->name}\" />\n";
    }
}

// Classe abstraite décorateur qui implémente également l'interface
abstract class HtmlDecorator implements HtmlElement
{
    public function __construct(protected HtmlElement $element)
    {
    }
    public function getName()
    {
        return $this->element->getName();
    }
}

// décorateur concret
class LabelDecorator extends HtmlDecorator
{
    protected $label;
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }
    public function __toString()
    {
        $name = $this->getName();
        $label = $this->label ?? '';
        return "<label for=\"{$name}\">{$label}"
            . $this->element->__toString()
            . "</label>\n";
    }
}

// décorateur concret
class ErrorDecorator extends HtmlDecorator
{
    protected $error;
    public function setError($message)
    {
        $this->error = $message;
    }
    public function __toString()
    {
        return $this->element->__toString() . "<span>{$this->error}</span>\n";
    }
}

$inputLabel =new LabelDecorator ( new Input(name:'username', type: 'text') );
$inputLabel->setLabel('Username: ');
echo $inputLabel;

echo (new LabelDecorator ( new Input(name:'username', type: 'text') ))->setLabel('USERNAME: ');