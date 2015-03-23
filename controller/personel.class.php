<?php

class PersonelController extends ControllerSecureLib
{

    public function index()
    {
        $collp = new PersonelsModel();
        $this->personels = $collp->getAll(null, 'name');
    }

    public function export()
    {
        $collp = new PersonelsModel();
        $this->personels = $collp->getAll(null, 'name');

        $colll = new LicensesModel();
        $this->vlicenses = $colll->getAllVehicle();
        $this->tlicenses = $colll->getAllTrailer();

        $collc = new PersonelchecksModel();
        $this->checks = $collc->getAll(null,'name');

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=personel.csv ");
        header("Content-Transfer-Encoding: binary ");

        return self::RETURN_EMPTY;
    }

    public function show($id) {
        $collp = new PersonelsModel();
        $this->personel = $collp->get($id);

        $collm = new MissionsModel();
        $this->missions = $collm->getAll(sprintf('personel_id = %d AND end >= %d',$this->personel->id, time()));
    }

    public function create()
    {
        $this->errors = array();
        $collp = new PersonelsModel();
        $collr = new RanksModel();
        $coll = new LicensesModel();
        $collg = new PersonelgroupsModel();
        $collc = new PersonelchecksModel();
        $collh = new LicensehaspersonelsModel();
        $collh2 = new PersonelhaspersonelchecksModel();
        $this->ranks = $collr->getAll(null, 'name');
        $this->vehicle_licenses = $coll->getAllVehicle();
        $this->trailer_licenses = $coll->getAllTrailer();
        $this->groups = $collg->getAll(null, 'name');
        $this->checks = $collc->getAll(null, 'name');
        if (RoutingLib::isPost()) {
            $values = $_POST;
            if (count($errors = $collp->validate($values)) == 0) {

                $values['discharged'] = dt($values['discharged']);
                $vl = isset($values['vehicle_licences_id']) ? $values['vehicle_licences_id'] : array();
                $tl = isset($values['trailer_licences_id']) ? $values['trailer_licences_id'] : array();
                $post_licenses_id = array_merge($vl,$tl);

                $post_checks_id = isset($values['personel_checks_id']) ? $values['personel_checks_id'] : array();

                $this->personel = $collp->create(RoutingLib::cleanPost($values));
                $this->personel->save();
                $id = $this->personel->id;

                foreach($post_licenses_id as $lid)
                {
                    $h = $collh->create(array('personel_id'=>$id,'license_id'=>$lid ));
                    $h->save();
                }

                foreach($post_checks_id as $cid)
                {
                    $h = $collh2->create(array('personel_id'=>$id,'personelcheck_id'=>$cid ));
                    $h->save();
                }

                $this->redirect(url('personel', 'index'));
            } else {
                $this->errors = $errors;
            }
        }
    }

    public function edit($id)
    {
        $this->errors = array();
        $collp = new PersonelsModel();
        $collr = new RanksModel();
        $coll = new LicensesModel();
        $collg = new PersonelgroupsModel();
        $collc = new PersonelchecksModel();
        $collh = new LicensehaspersonelsModel();
        $collh2 = new PersonelhaspersonelchecksModel();
        $this->ranks = $collr->getAll(null, 'name');
        $this->personel = $collp->get($id);
        $this->vehicle_licenses = $coll->getAllVehicle();
        $this->trailer_licenses = $coll->getAllTrailer();
        $this->groups = $collg->getAll(null, 'name');
        $this->checks = $collc->getAll(null, 'name');
        if (RoutingLib::isPost()) {
            $values = $_POST;

            $values['discharged'] = dt($values['discharged']);
            $vl = isset($values['vehicle_licences_id']) ? $values['vehicle_licences_id'] : array();
            $tl = isset($values['trailer_licences_id']) ? $values['trailer_licences_id'] : array();
            $post_checks_id = isset($values['personel_checks_id']) ? $values['personel_checks_id'] : array();

            $post_licenses_id = array_merge($vl,$tl);
            $pers_licenses_id = $this->personel->getLicensesId();

            $pers_checks_id = $this->personel->getPersonelchecksId();

            if (count($errors = $collp->validate($values)) == 0) {
                $this->personel->update(RoutingLib::cleanPost($values));
                $this->personel->save();

                $add_license_id = array_diff($post_licenses_id, $pers_licenses_id);
                foreach($add_license_id as $lid)
                {
                    $h = $collh->create(array('personel_id'=>$id,'license_id'=>$lid ));
                    $h->save();
                }

                $add_checks_id = array_diff($post_checks_id, $pers_checks_id);
                foreach($add_checks_id as $cid)
                {
                    $h = $collh2->create(array('personel_id'=>$id,'personelcheck_id'=>$cid ));
                    $h->save();
                }


                $del_license_id = array_diff($pers_licenses_id, $post_licenses_id);
                foreach($del_license_id as $lid)
                {
                    $collh->deleteWhere(sprintf('personel_id = %d AND license_id = %d',$id,$lid));
                }

                $del_checks_id = array_diff($pers_checks_id, $post_checks_id);
                foreach($del_checks_id as $cid)
                {
                    $collh2->deleteWhere(sprintf('personel_id = %d AND personelcheck_id = %d',$id,$cid));
                }

                $this->redirect(url('personel', 'index'));
            } else {
                $this->errors = $errors;
            }

        }
    }

    public function delete($id)
    {
        $coll = new PersonelsModel();
        $collc = new PersonelhaspersonelchecksModel();
        $colll = new LicensehaspersonelsModel();
        $collc->deleteWhere(sprintf('personel_id = %d',$id));
        $colll->deleteWhere(sprintf('personel_id = %d',$id));
        $this->personel = $coll->get($id);
        $this->personel->delete();
        $this->redirect(url('personel', 'index'));
    }

    public function import()
    {
        $this->errors = array();
        $this->file = null;
        $this->lines = array();

        $collp = new PersonelsModel();
        $collg = new PersonelgroupsModel();
        $colll = new LicensesModel();
        $collr = new RanksModel();
        $collh1 = new LicensehaspersonelsModel();
        $collh2 = new PersonelhaspersonelchecksModel();

        $groups = $collg->getAll();
        $licenses = $colll->getAll();
        $ranks = $collr->getAll();

        $lid4col = $cid4col = array();

        if (RoutingLib::isPost())
        {
            $values = RoutingLib::cleanPost($_POST);
            $this->file = $values['import_file'];
            $tmp = array();
            $fp = fopen($this->file, 'r');

            //Grade|Nom/Prénom|Section|langue|Feu. Rép|drogue|910|920|921|920E|921E|930|931|930E|931E|Instruction|N° téléphone
            $cid4col = array(
                4 => 1, // repetitorium
                5 => 2, // drogue
                15 => 3, // instr.
            );

            $data = fgetcsv($fp);
            foreach($data as $idx => $name)
            {
                foreach($licenses as $li => $l) { if($l->name == $name) { $lid4col[$idx] = $l->id; } }
            }

            $i = 1;
            while($data = fgetcsv($fp))
            {
                try {

                    $rankid = null;
                    foreach($ranks as $rid => $rank) { if($rank->name == $data[0]) { $rankid = $rid; } }
                    if(!$rankid) { throw new Exception("Could not find rank: {$data[0]}"); }

                    $groupid = null;
                    foreach($groups as $gid => $group) { if($group->short_name == $data[2]) { $groupid = $gid; } }
                    if(!$groupid) { throw new Exception("Could not find group: {$data[2]}"); }

                    //$data[0] = $rankid;

                    if ($data[1] && $rankid && $groupid) {
                        $obj = array(
                            'rank_id' => $rankid,
                            'name' => $data[1],
                            'group_id' => $groupid,
                            'tel' => $data[16] ? $data[16] : null,
                        );
                        $p = $collp->create($obj);
                        $p->save();

                        foreach($lid4col as $idx => $lid)
                        {
                            if(trim($data[$idx]))
                            {
                                $data[$idx] = $lid;
                                $h = $collh1->create(array(
                                    'personel_id' => $p->id,
                                    'license_id'=> $lid,
                                ));
                                $h->save();
                            }
                        }

                        foreach($cid4col as $idx => $cid)
                        {
                            if(trim($data[$idx]))
                            {
                                $data[$idx] = $cid;
                                $h = $collh2->create(array(
                                    'personel_id' => $p->id,
                                    'personelcheck_id'=> $cid,
                                ));
                                $h->save();
                            }
                        }

                    }


                    $tmp[$i] = 'Ok';
                    //$tmp[$i] .= ' '.implode('|',$data);

                }
                catch(Exception $e) {
                    $tmp[$i] = 'Error '.$e->getMessage();
                }

                $i++;
            }
            fclose($fp);
            $this->lines = $tmp;
            unlink($this->file);
        }
    }

}
