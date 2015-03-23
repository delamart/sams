<?php

class RankController extends ControllerSecureLib
{

    public function index()
    {
        $this->errors = array();
        $coll = new RanksModel();
        $this->objs = $coll->getAll(null, '`order` ASC');

        if(RoutingLib::isPost())
        {
            $values = RoutingLib::cleanPost($_POST);

            if(count($errors = $coll->validate($values)) == 0)
            {
                if($values['id']) {
                    $this->obj = $coll->get($values['id']);
                    $this->obj->update($values);
                }
                else
                {
                    $this->obj = $coll->create($values);
                }
                $this->obj->save();
                $this->redirect(url('rank','index'));
            }
            else
            {
                $this->errors = $errors;
            }
        }
    }

    public function delete($id) {
        $coll = new RanksModel();
        $this->obj = $coll->get($id);
        $this->obj->delete();
        $this->redirect(url('rank','index'));
    }

}