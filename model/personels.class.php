<?php

class PersonelsModel extends CollectionDbLib {
    
     protected function init()
     {
         $this->obj_class = 'PersonelModel';
         $this->table = 'personel';
         $this->pk_column = 'id';
         $this->columns = array('id', 'rank_id', 'name', 'group_id', 'tel', 'discharged');
         parent::init();
     }

    public function getByVehicle(VehicleModel $vehicle = null, $where = '', $order = '')
    {
        if(!$vehicle) { return $this->getAll($where, $order); }

        $id = $vehicle->getVtype()->license_id;
        $coll = new LicensehaspersonelsModel();

        $where = $where ? sprintf('WHERE %s',$where) : '';
        $order = $order ? sprintf('ORDER BY %s',$order) : '';

        $query = sprintf('SELECT t.* FROM %s AS t JOIN %s AS j ON (j.personel_id = t.id AND j.license_id = %d) %s %s',
            $this->table, $coll->table, $id, $where, $order);

        return $this->getCustom($query);

    }
}