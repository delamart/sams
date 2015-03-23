<?php

    $this->setRaw();

    const EXPORT_CSV_QUOTE = '"';
    const EXPORT_CSV_DELIMITER = ';';

    echo EXPORT_CSV_QUOTE.TranslateLib::translateText('Rank').EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;
    echo EXPORT_CSV_QUOTE.TranslateLib::translateText('Name').EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;
    echo EXPORT_CSV_QUOTE.TranslateLib::translateText('Personel Group').EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;
    echo EXPORT_CSV_QUOTE.TranslateLib::translateText('Tel').EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;

    foreach($this->vlicenses as $id => $license)
    {
        echo EXPORT_CSV_QUOTE.$license->name.EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;
    }

    foreach($this->tlicenses as $id => $license)
    {
        echo EXPORT_CSV_QUOTE.$license->name.EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;
    }
    foreach($this->checks as $id => $check)
    {
        echo EXPORT_CSV_QUOTE.$check->name.EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;
    }

    echo EXPORT_CSV_QUOTE.TranslateLib::translateText('Discharged').EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;

    echo "\r\n";

    foreach($this->personels as $id => $personel) {
        $l_ids = $personel->getLicensesId();
        $c_ids = $personel->getPersonelchecksId();

        echo EXPORT_CSV_QUOTE.$personel->getRankName().EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;
        echo EXPORT_CSV_QUOTE.$personel->name.EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;
        echo EXPORT_CSV_QUOTE.$personel->getPersonelgroupShort().EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;
        echo EXPORT_CSV_QUOTE.$personel->tel.EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;

        foreach ($this->vlicenses as $id => $license)
        {
            echo EXPORT_CSV_QUOTE;
            echo isset($l_ids[$id]) ? 'x' : '';
            echo EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;
        }
        foreach ($this->tlicenses as $id => $license)
        {
            echo EXPORT_CSV_QUOTE;
            echo isset($l_ids[$id]) ? 'x' : '';
            echo EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;
        }
        foreach ($this->checks as $id => $check)
        {
            echo EXPORT_CSV_QUOTE;
            echo isset($c_ids[$id]) ? 'x' : '';
            echo EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;
        }

        echo EXPORT_CSV_QUOTE.dt($personel->discharged).EXPORT_CSV_QUOTE.EXPORT_CSV_DELIMITER;

        echo "\r\n";
    }