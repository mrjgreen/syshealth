<?php namespace Syshealth\System\DataSource\Windows;

use Syshealth\System\DataParser\DfTableParser;
use Syshealth\System\DataSource\DataSourceAbstract;
use Syshealth\System\Entity\DiskEntity;

class Disk extends DataSourceAbstract
{
    public function __construct()
    {
        parent::__construct('fsutil fsinfo drives', new DfTableParser());
    }

    public function getDiskUsage()
    {

    }
}