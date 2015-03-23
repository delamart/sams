<?php

class LicensesModel extends CollectionDbLib {
    
     protected function init()
     {
         $this->obj_class = 'LicenseModel';
         $this->table = 'license';
         $this->pk_column = 'id';
         $this->columns = array('id', 'name', 'description', 'trailer');
         parent::init();
     }

    public function getAllVehicle()
    {
        return parent::getAll('trailer=0');
    }

    public function getAllTrailer()
    {
        return parent::getAll('trailer=1');
    }

    public function getAllForPersonel(PersonelModel $personel, $where = null, $order = null)
    {
        $id = $personel->id;
        $coll = new LicensehaspersonelsModel();

        $where = $where ? sprintf('WHERE %s',$where) : '';
        $order = $order ? sprintf('ORDER BY %s',$order) : '';

        $query = sprintf('SELECT t.* FROM %s AS t JOIN %s AS j ON (j.license_id = t.id AND j.personel_id = %d) %s %s',
                            $this->table, $coll->table, $id, $where, $order);

        return $this->getCustom($query);
    }

}