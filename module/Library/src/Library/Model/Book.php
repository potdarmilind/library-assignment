<?php

namespace Library\Model;

 class Book
 {
     public $id;
     public $name;
     public $issued;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->name = (!empty($data['name'])) ? $data['name'] : null;
         $this->issued  = (!empty($data['issued'])) ? $data['issued'] : null;
     }
 }