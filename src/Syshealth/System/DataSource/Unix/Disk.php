<?php namespace Syshealth\System\DataSource\Unix;

use Syshealth\System\DataParser\DfTableParser;
use Syshealth\System\DataSource\DataSourceAbstract;
use Syshealth\System\Entity\DiskEntity;

class Disk extends DataSourceAbstract
{
    public function __construct()
    {
        parent::__construct('df -P', new DfTableParser());
    }

    public function getDiskUsage()
    {
        return array_map(function($row){
            return new DiskEntity($row['Filesystem'], $row['Mounted on'], $row['Available'], $row['Used']);
        }, $this->readData());
    }
}