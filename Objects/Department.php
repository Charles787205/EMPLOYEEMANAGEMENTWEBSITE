<?php

  class Department{

    private String $name;
    private int $id;

    public function setName($name){
      $this->name = $name;
    }
    public function setId($id){
      $this->id  = $id;

    }
    public function getName(){
      return $this->name;
    }
    public function getId(){
      return $this->id;
    }
  }
  