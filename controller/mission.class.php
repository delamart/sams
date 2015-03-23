<?php

class MissionController extends ControllerSecureLib
{

    public function index() {
        $collm = new MissionsModel();
        $this->missions = $collm->getAll(sprintf('end > %d', time()),'start ASC, end ASC');
    }

    public function history() {
        $collm = new MissionsModel();
        $this->missions = $collm->getAll(null,'summary');
    }

    public function show($id) {
        $collm = new MissionsModel();
        $this->mission = $collm->get($id);
    }

    public function create() {
        $this->errors = array();
        $this->step = 'start';
        $collm = new MissionsModel();
        $collv = new VehiclesModel();
        $collp = new PersonelsModel();
        if(RoutingLib::isPost())
        {
            $values = $_POST;
            $this->step = $values['step'];
            if(count($errors = $collm->validate($values)) == 0)
            {
                $this->vehicle = isset($values['vehicle_id']) ? $collv->get($values['vehicle_id']) : null;
                $this->personel = isset($values['personel_id']) ? $collp->get($values['personel_id']) : null;

                switch($this->step)
                {
                    case 'confirm':
                        $obj = $values;
                        $obj['start'] = dt($obj['start']);
                        $obj['end'] = dt($obj['end']);
                        $this->mission = $collm->create(RoutingLib::cleanPost($obj));
                        $this->mission->save();
                        $this->redirect(url('mission', 'show', $this->mission->id));
                        break;
                    case 'assign-vehicle':
                        $this->step = 'assign-personel';
                        $this->personels = $collp->getByVehicle($this->vehicle,null,'name');
                        break;
                    case 'assign-personel':
                        $this->step = 'confirm';
                        break;
                    case 'start':
                    default:
                        $this->step = 'assign-vehicle';
                        $this->vehicles = $collv->getAll(null,'number');
                }
            }
            else
            {
                $this->errors = $errors;
            }
        }
    }

    public function edit($id) {
        $this->errors = array();
        $collm = new MissionsModel();
        $collv = new VehiclesModel();
        $collp = new PersonelsModel();
        $this->vehicles = $collv->getAll(null,'number');
        $this->personels = $collp->getAll(null,'name');
        $this->mission = $collm->get($id);
        if(RoutingLib::isPost())
        {
            $values = $_POST;
            if(count($errors = $collm->validate($values)) == 0)
            {
                $values['start'] = dt($values['start']);
                $values['end'] = dt($values['end']);

                $this->mission->update(RoutingLib::cleanPost($values));
                $this->mission->save();
                $this->redirect(url('mission','index'));
            }
            else
            {
                $this->errors = $errors;
            }
        }
    }

    public function delete($id) {
        $coll = new MissionsModel();
        $this->mission = $coll->get($id);
        $this->mission->delete();
        $this->redirect(url('mission','index'));
    }

}
