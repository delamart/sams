<?php

class MissionModel extends ModelDbLib {

    private $vehicle = null;

    public function __construct(CollectionDbLib $collection, array $data = array())
    {
        parent::__construct($collection, $data);
    }

    public function getVehicle()
    {
        if(!$this->vehicle) {
            $coll = new VehiclesModel();
            $this->vehicle = $coll->get($this->vehicle_id);
        }
        return $this->vehicle;
    }

    public function getVehicleFull()
    {
        $vehicle = $this->getVehicle();
        return $vehicle ? $vehicle->getFullName() : null;
    }

    public function getPersonel()
    {
        if(!$this->personel) {
            $coll = new PersonelsModel();
            $this->personel = $coll->get($this->personel_id);
        }
        return $this->personel;
    }

    public function getPersonelFull()
    {
        $personel = $this->getPersonel();
        return $personel ? $personel->getFullName() : null;
    }

    public function startHTML()
    {
        $start = $this->start;
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
        elseif(($start <= time()) && ($this->end >= time())) //current
        {
            $style = 'danger';
            $diff = time() - $start;
            if($diff >= (24*60*60) ) //+24h
            {
                $txt = '-24h+';
            }
            elseif($diff >= (60*60)) //+1h
            {
                $txt = '-'.round($diff / (60*60)) . 'h' . str_pad((round($diff / 60) % 60),2,'0',STR_PAD_LEFT);
            }
            else
            {
                $txt = '-'.round($diff / 60) . 'min';
            }
        }
        else //past
        {
            $style = 'default';
            $txt = 'expired';
        }
        echo '<a href="'.url('mission','show',$this->id).'" class="btn btn-xs btn-'.$style.'" title="'.dt($start,'long').'">'.$txt.'</a>';
    }

    public function endHTML()
    {
        $start = $this->start;
        $end = $this->end;
        if($start > time()) //future
        {
            $style = 'default';
            $diff = $end - time();
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
        elseif(($start <= time()) && ($this->end >= time())) //current
        {
            $style = 'success';
            $diff = $end - time();
            if($diff >= (24*60*60) ) //+24h
            {
                $txt = '+24h';
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
        else //past
        {
            $style = 'default';
            $txt = 'expired';
        }
        echo '<a href="'.url('mission','show',$this->id).'" class="btn btn-xs btn-'.$style.'" title="'.dt($end,'long').'">'.$txt.'</a>';
    }

}
