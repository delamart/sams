<?php

class VtypeModel extends ModelDbLib {
    
    public function __construct(CollectionDbLib $collection, array $data = array())
    {
        parent::__construct($collection, $data);
    }

    public function getLicense()
    {
        if(!$this->license) {
            $coll = new LicensesModel();
            $this->license = $coll->get($this->license_id);
        }
        return $this->license;
    }

    public function getLicenseName()
    {
        $license = $this->getLicense();
        return $license ? $license->name : null;
    }


    public function getLicenseTrailer()
    {
        if(!$this->license) {
            $coll = new LicensesModel();
            $this->license_trailer = $coll->get($this->license_trailer_id);
        }
        return $this->license_trailer;
    }

    public function getLicenseTrailerName()
    {
        $license = $this->getLicenseTrailer();
        return $license ? $license->name : null;
    }

}
