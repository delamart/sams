<?php

class DefaultController extends ControllerSecureLib {
    
    function index() {

        $collv = new VehiclesModel();
        $collm = new MissionsModel();

        $this->vehicles = $collv->getAll();
        $this->missions = $collm->getAll();

    }
    
}