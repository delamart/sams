<?php

class PersonelchecksModel extends CollectionDbLib {
    
     protected function init()
     {
         $this->obj_class = 'PersonelcheckModel';
         $this->table = 'personelcheck';
         $this->pk_column = 'id';
         $this->columns = array('id', 'name', 'description');
         parent::init();
     }

    public function getAllForPersonel(PersonelModel $personel, $where = null, $order = null)
    {
        $id = $personel->id;
        $coll = new PersonelhaspersonelchecksModel();

        $where = $where ? sprintf('WHERE %s',$where) : '';
        $order = $order ? sprintf('ORDER BY %s',$order) : '';

        $query = sprintf('SELECT t.* FROM %s AS t JOIN %s AS j ON (j.personelcheck_id = t.id AND j.personel_id = %d) %s %s',
            $this->table, $coll->table, $id, $where, $order);

        return $this->getCustom($query);
    }

}