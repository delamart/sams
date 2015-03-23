<?php

class RanksModel extends CollectionDbLib {
    
     protected function init()
     {
         $this->obj_class = 'RankModel';
         $this->table = 'rank';
         $this->pk_column = 'id';
         $this->columns = array('id', 'order', 'short_name', 'name');
         parent::init();
     }
     
}