<?php namespace Syshealth\System\DataSource\Unix\Mac;

use Syshealth\System\DataParser\KeyValueParser;
use Syshealth\System\DataSource\DataSourceAbstract;
use Syshealth\System\Entity\MemoryEntity;

class Memory {

    public function getMemoryInfo()
    {
        return new MemoryEntity(0, 0, 0, 0, 0, 0, 0, 0);
    }
}