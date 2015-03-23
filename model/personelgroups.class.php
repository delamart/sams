<?php

class PersonelgroupsModel extends CollectionDbLib {
    
     protected function init()
     {
         $this->obj_class = 'PersonelgroupModel';
         $this->table = 'personelgroup';
         $this->pk_column = 'id';
         $this->columns = array('id', 'short_name', 'name');
         parent::init();
     }
     
}