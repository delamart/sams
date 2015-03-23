<?php

class VtypesModel extends CollectionDbLib {
    
     protected function init()
     {
         $this->obj_class = 'VtypeModel';
         $this->table = 'vtype';
         $this->pk_column = 'id';
         $this->columns = array('id', 'name', 'license_id', 'license_trailer_id');
         parent::init();
     }
     
}