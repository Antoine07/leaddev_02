<?php

namespace App;

class User
{
    protected $pdo = null;
    protected $id;
    protected $email;
    protected $history_count;

    public function __construct(

        protected $dsn
    ) {
        $this->dsn = $dsn;

        $this->pdo = FactoryPDO::buildSqlite($dsn);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of history_count
     */ 
    public function getHistoryCount():int
    {
        return $this->history_count;
    }

    /**
     * Set the value of history_count
     *
     * @return  self
     */ 
    public function setHistoryCount(int $historyCount)
    {
        $this->history_count = $historyCount;
    }

    public function find(int $id){
        $prepare = $this->pdo->prepare('SELECT * FROM users WHERE id=?');

        $prepare->bindValue(1, $id);
        $prepare->execute();

        return $prepare->fetchObject(User::class, [$this->dsn]);
    }

    public function all(){
        $prepare = $this->pdo->prepare('SELECT * FROM users');
        $prepare->execute();

        return $prepare->fetchAll(\PDO::FETCH_CLASS);
    }

    public function persist():void{
        $prepare = $this->pdo->prepare('UPDATE users SET history_count= ? WHERE id = ?');

        $prepare->bindValue(1, $this->getHistoryCount());
        $prepare->bindValue(2, $this->id);

        $prepare->execute();

    }
}
