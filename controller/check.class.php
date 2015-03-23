<?php

class CheckController extends ControllerSecureLib
{

    public function index()
    {
        $collp = new PersonelsModel();
        $collc = new PersonelchecksModel();
        $this->personels = $collp->getAll(null, 'name');
        $this->checks = $collc->getAll(null, 'name');
    }

    public function edit()
    {
        $this->errors = array();
        $collc = new PersonelchecksModel();
        $this->checks = $collc->getAll(null, 'name');

        if(RoutingLib::isPost())
        {
            $values = RoutingLib::cleanPost($_POST);

            if(count($errors = $collc->validate($values)) == 0)
            {
                if($values['id']) {
                    $this->check = $collc->get($values['id']);
                    $this->check->update($values);
                }
                else
                {
                    $this->check = $collc->create($values);
                }
                $this->check->save();
                $this->redirect(url('check','edit'));
            }
            else
            {
                $this->errors = $errors;
            }
        }
    }

    public function delete($id) {
        $coll = new PersonelchecksModel();
        $this->check = $coll->get($id);
        $this->check->delete();
        $this->redirect(url('check','edit'));
    }

}