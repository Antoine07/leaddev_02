<?php

namespace App\Model;

class Person{

    public function __construct(
        private string $name,
        private int $id,
        private array $relations = [],
        )
    {
        
    }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of relation
         */ 
        public function getRelations()
        {
                return $this->relations;
        }

        /**
         * Set the value of relation
         *
         * @return  self
         */ 
        public function addRelation($relationId)
        {
                $this->relations[] = $relationId;

                return $this;
        }
}