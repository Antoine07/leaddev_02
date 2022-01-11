<?php

class User implements SplSubject{

    private $id;
   
    public function attach(SplObserver $observer) {
        $this->observers[] = $observer;
    }

    public function detach(SplObserver $observer){}

    public function notify() {

        foreach ($this->observers as $value) {
            $value->update($this); // tout l'objet est 
        }
    }

    public function create(string $name, string $email):void {

        $this->id = uniqid(true); // quelque chose c'est passée dans la classe User que l'on souhaite notifier

        $this->notify();
    }

    public function update(string $name){
        $this->id = uniqid(true);

        $this->notify();
    }

    public function getId(){
        return $this->id;
    }
}


class Log implements SplObserver{

    public function update( SplSubject $subject) {
        echo "log :" . $subject->getId() . "\n";
    }
}

$user = new User;

$user->attach(new Log);
$user->attach(new Log);
$user->attach(new Log);
$user->attach(new Log);

// Comportenement => j'ai créer ou enregistrer quelque chose dans une base de données
$user->create('Alan', 'alan@alan.fr');

// réagir par rapport à une autre action
$user->update('Alan');