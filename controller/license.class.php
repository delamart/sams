<?php

class LicenseController extends ControllerSecureLib
{

    public function index()
    {
        $this->errors = array();
        $coll = new LicensesModel();
        $this->objs = $coll->getAll(null, 'name');

        if(RoutingLib::isPost())
        {
            $values = RoutingLib::cleanPost($_POST);

            $values['trailer'] = (isset($values['trailer']) && $values['trailer'] == 1) ? 1 : 0;

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
                $this->redirect(url('license','index'));
            }
            else
            {
                $this->errors = $errors;
            }
        }
    }

    public function delete($id) {
        $coll = new LicensesModel();
        $this->obj = $coll->get($id);
        $this->obj->delete();
        $this->redirect(url('license','index'));
    }

}