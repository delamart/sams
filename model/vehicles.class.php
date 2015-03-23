<?php

class VehiclesModel extends CollectionDbLib {
    
     protected function init()
     {
         $this->obj_class = 'VehicleModel';
         $this->table = 'vehicle';
         $this->pk_column = 'id';
         $this->columns = array('id', 'vtype_id', 'number');
         parent::init();
     }
     
}