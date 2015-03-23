<?php

class UsersModel extends CollectionDbLib {
    
     protected function init()
     {
         $this->obj_class = 'UserModel';
         $this->table = 'user';
         $this->pk_column = 'id';
         $this->columns = array('id', 'username', 'password', 'name');
         parent::init();
     }

     public function validate(array &$values)
     {         
         $errors = parent::validate($values);                  
         return $errors;
     }     
     
}