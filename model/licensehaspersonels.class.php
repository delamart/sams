<?php

class LicensehaspersonelsModel extends CollectionDbLib {
    
     protected function init()
     {
         $this->obj_class = 'LicensehaspersonelModel';
         $this->table = 'personel_has_license';
         $this->pk_column = 'id';
         $this->columns = array('id', 'personel_id', 'license_id');
         parent::init();
     }

}