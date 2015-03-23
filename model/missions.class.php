<?php

class MissionsModel extends CollectionDbLib {
    
     protected function init()
     {
         $this->obj_class = 'MissionModel';
         $this->table = 'mission';
         $this->pk_column = 'id';
         $this->columns = array('id', 'vehicle_id', 'personel_id', 'summary', 'description', 'start',
                                'end', 'load', 'origin', 'destination', 'contact_name', 'contact_tel');
         parent::init();
     }

    public function countActive()
    {
        return $this->countAll(sprintf('end > %d',time()));
    }

}