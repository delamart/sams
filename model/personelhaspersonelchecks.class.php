<?php

class PersonelhaspersonelchecksModel extends CollectionDbLib {
    
     protected function init()
     {
         $this->obj_class = 'PersonelhaspersonelcheckModel';
         $this->table = 'personel_has_personelcheck';
         $this->pk_column = 'id';
         $this->columns = array('id', 'personel_id', 'personelcheck_id');
         parent::init();
     }

}