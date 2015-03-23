<?php

class VehicleModel extends ModelDbLib {
    
	private $vtype = null;
    private $license = null;
    private $license_trailer = null;

    public function __construct(CollectionDbLib $collection, array $data = array())
    {
        parent::__construct($collection, $data);
    }
	
    public function getFullName()
	{
		return trim($this->getVtypeName() . ' ' . $this->number);
	}

    public function getVtypeName()
	{
		$vtype = $this->getVtype();
		return $vtype ? $vtype->name : null;
	}

	public function getVtype()
	{
        if(!$this->vtype) {
            $collt = new VtypesModel();
            $this->vtype = $collt->get($this->vtype_id);
        }
		return $this->vtype;
	}

    public function getMissionHTML()
    {
        $where = sprintf('vehicle_id=%d AND end >= %d',$this->id,time());

        $collm = new MissionsModel();
        $missions = $collm->getAll($where,'start ASC','1');
        if(count($missions) ==  0)
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
