<?php namespace Syshealth\System\DataSource\Unix\Windows;

use Syshealth\System\DataParser\KeyValueParser;
use Syshealth\System\DataSource\DataSourceAbstract;
use Syshealth\System\Entity\MemoryEntity;

class Memory extends DataSourceAbstract
{
    public function __construct()
    {
        parent::__construct('systeminfo |find "Memory"', new KeyValueParser());
    }

    public function getMemoryInfo()
    {
        $data = $this->readData();

        return new MemoryEntity(
            $data['Total Physical Memory'],
            $data['Available Physical Memory'],
            0,
            0,
            0);
    }
}