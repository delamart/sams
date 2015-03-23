<?php

class PersonelModel extends ModelDbLib
{

    private $rank = null;
    private $personel_group = null;

    public function __construct(CollectionDbLib $collection, array $data = array())
    {
        parent::__construct($collection, $data);
    }

    public function getFullName()
    {
        $group = $this->getPersonelgroupShort();
        $group = $group ? '(' . TranslateLib::translateText('Personel Group') . ': ' . $group.')':'';
        return trim($this->getRankShort() . ' ' . $this->name . ' ' . $group);
    }

    public function getSearchName()
    {
        $name_fix = remove_accents($this->name);
        $name = $this->name;
        return ($name_fix == $name)? $name : $name_fix.'|'.$name;
    }

    public function getRank()
    {
        if (!$this->rank) {
            $collr = new RanksModel();
            $this->rank = $collr->get($this->rank_id);
        }
        return $this->rank;
    }

    public function getRankOrder()
    {
        $rank = $this->getRank();
        return $rank ? $rank->order : null;
    }

    public function getRankShort()
    {
        $rank = $this->getRank();
        return $rank ? $rank->short_name : null;
    }

    public function getRankName()
    {
        $rank = $this->getRank();
        return $rank ? $rank->name : null;
    }

    public function getPersonelgroup()
    {
        if (!$this->personel_group) {
            $collr = new PersonelgroupsModel();
            $this->personel_group = $collr->get($this->group_id);
        }
        return $this->personel_group;
    }

    public function getPersonelgroupShort()
    {
        $group = $this->getPersonelgroup();
        return $group ? $group->short_name : null;
    }

    public function getPersonelgroupName()
    {
        $group = $this->getPersonelgroup();
        return $group ? $group->name : null;
    }

    public function getPersonelchecks($where = null, $order = null)
    {
        $coll = new PersonelchecksModel();
        return $coll->getAllForPersonel($this,$where,$order);
    }

    public function getPersonelchecksId($where = null)
    {
        $out = array();
        $coll = new PersonelhaspersonelchecksModel();
        $where = ($where ? $where.' AND ' : '') . sprintf('personel_id = %d',$this->id);
        $tmp = $coll->getAll($where);
        foreach($tmp as $t) { $out[$t->personelcheck_id] = $t->personelcheck_id; }
        return $out;
    }

    public function getPersonelchecskNames($where = null, $order = null)
    {
        $out = array();
        $c = $this->getPersonelchecks($where,$order);
        foreach($c as $cc) { $out[] = $cc->name; }
        return implode(', ',$out);
    }

    public function getLicenses($where = null, $order = null)
    {
        $coll = new LicensesModel();
        return $coll->getAllForPersonel($this,$where,$order);
    }

    public function getLicensesId($where = null)
    {
        $out = array();
        $coll = new LicensehaspersonelsModel();
        $where = ($where ? $where.' AND ' : '') . sprintf('personel_id = %d',$this->id);
        $tmp = $coll->getAll($where);
        foreach($tmp as $t) { $out[$t->license_id] = $t->license_id; }
        return $out;
    }

    const WHERE_LICENSE_VEHICLE = 'trailer=0';
    const WHERE_LICENSE_TRAILER = 'trailer=1';

    public function getLicensesNames($where = null, $order = null)
    {
        $out = array();
        $l = $this->getLicenses($where,$order);
        foreach($l as $ll) { $out[] = $ll->name; }
        return implode(', ',$out);
    }

    public function getLicensesFullNames($where = null, $order = null)
    {
        $out = array();
        $l = $this->getLicenses($where,$order);
        foreach($l as $ll) { $out[] = $ll->getFullName(); }
        return implode(', ',$out);
    }

    public function __set($name, $value)
    {
        switch($name)
        {
            case 'rank': $this->rank_id = $this->findRankId($value); return void; break;
            case 'rank_id': $value = $this->findRankId($value); break;
        }

        parent::__set($name,$value);
    }

    private function findRankId($value)
    {
        static $cache = null;

        if(is_numeric($value))
        {
            return $value;
        }
        else
        {
            if(!$cache)
            {
                $collr = new RanksModel();
                $cache = $collr->getAll();
            }
            if(!isset($cache[$value])) {
                foreach ($cache as $id => $rank) {
                    if (strcasecmp($rank->name, $value) === 0) {
                        $cache[$value] = $id;
                        break;
                    } elseif (strcasecmp($rank->short_name, $value) === 0) {
                        $cache[$value] = $id;
                        break;
                    }
                }
            }
            if(isset($cache[$value])) { return $cache[$value]; }
            throw new Exception("Could not find rank: '$value''");
        }
        return false;
    }



    public function getMissionHTML()
    {
        $where = sprintf('personel_id=%d AND end >= %d',$this->id,time());

        $collm = new MissionsModel();
        $missions = $collm->getAll($where,'start ASC','1');
        if($this->discharged && ($this->discharged <= time()))
        {
            $url = url('personel','show',$this->id);
            $style = 'danger';
            $txt = $title = TranslateLib::translateText('Discharged');
        }
        elseif(count($missions) ==  0)
        {
            $url = url('mission','index');
            $style = 'default';
            $txt = $title = TranslateLib::translateText('none');
        }
        else
        {
            $mission = reset($missions);
            $start = $mission->start;
            $end = $mission->end;
            $title = dt($start,'long');
            $url = url('mission','show',$mission->id);

            if($start > time()) //future
            {
                $style = 'success';
                $diff = $start - time();
                if($diff >= (24*60*60) ) //+24h
                {
                    $txt = ' +24h';
                }
                elseif($diff >= (60*60)) //+1h
                {
                    $txt = round($diff / (60*60)) . 'h' . str_pad((round($diff / 60) % 60),2,'0',STR_PAD_LEFT);
                }
                else
                {
                    $txt = round($diff / 60) . 'min';
                }
            }
            else //current
            {
                $style = 'danger';
                $diff = $end - time();
                if($diff >= (24*60*60) ) //+24h
                {
                    $txt = '-24h+';
                }
                elseif($diff >= (60*60)) //+1h
                {
                    $txt = '-' . round($diff / (60*60)) . 'h' . str_pad((round($diff / 60) % 60),2,'0',STR_PAD_LEFT);
                }
                else
                {
                    $txt = '-' . round($diff / 60) . 'min';
                }
            }
        }
        echo '<a href="'.$url.'" class="btn btn-xs btn-'.$style.'" title="'.$title.'">'.$txt.'</a>';
    }

}
