<?php

class VtypeController extends ControllerSecureLib
{

    public function index()
    {
        $this->errors = array();
        $coll = new VtypesModel();
        $colll = new LicensesModel();
        $this->objs = $coll->getAll(null, 'name');
        $this->vehicle_licenses = $colll->getAllVehicle();
        $this->trailer_licenses = $colll->getAllTrailer();

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
                $this->redirect(url('vtype','index'));
            }
            else
            {
                $this->errors = $errors;
            }
        }
    }

    public function delete($id) {
        $coll = new VtypesModel();
        $this->obj = $coll->get($id);
        $this->obj->delete();
        $this->redirect(url('vtype','index'));
    }

}