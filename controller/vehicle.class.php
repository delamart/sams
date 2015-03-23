<?php

class VehicleController extends ControllerSecureLib
{

    public function index() {
        $collv = new VehiclesModel();
        $this->vehicles = $collv->getAll(null,'number');
    }

    public function show($id) {
        $collv = new VehiclesModel();
        $this->vehicle = $collv->get($id);

        $collm = new MissionsModel();
        $this->missions = $collm->getAll(sprintf('vehicle_id = %d AND end >= %d',$this->vehicle->id, time()));
    }


    public function create() {
        $this->errors = array();
        $collp = new VehiclesModel();
        $collr = new VtypesModel();
        $this->vtypes = $collr->getAll(null,'name');
        if(RoutingLib::isPost())
        {
            $values = RoutingLib::cleanPost($_POST);

            if(count($errors = $collp->validate($values)) == 0)
            {
                $this->vehicle = $collp->create(RoutingLib::cleanPost($values));
                $this->vehicle->save();
                $this->redirect(url('vehicle','index'));
            }
            else
            {
                $this->errors = $errors;
            }
        }
    }

    public function edit($id) {
        $this->errors = array();
        $collp = new VehiclesModel();
        $collr = new VtypesModel();
        $this->vtypes = $collr->getAll(null,'name');
        $this->vehicle = $collp->get($id);
        if(RoutingLib::isPost())
        {
            $values = RoutingLib::cleanPost($_POST);
            $this->image = $values['image'];

            if(count($errors = $collp->validate($values)) == 0)
            {
                $this->vehicle->update(RoutingLib::cleanPost($values));
                $this->vehicle->save();
                $this->redirect(url('vehicle','index'));
            }
            else
            {
                $this->errors = $errors;
            }
        }
    }

    public function delete($id) {
        $coll = new VehiclesModel();
        $this->vehicle = $coll->get($id);
        $this->vehicle->delete();
        $this->redirect(url('vehicle','index'));
    }

}
