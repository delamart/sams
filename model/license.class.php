<?php

class LicenseModel extends ModelDbLib {
    
    public function __construct(CollectionDbLib $collection, array $data = array())
    {
        parent::__construct($collection, $data);
    }

    public function getFullName()
    {
        $trailer = $this->trailer ? '('.TranslateLib::translateText('trailer').')':'';
        return trim($this->name . ' ' . $this->description . ' ' . $trailer);
    }

}
