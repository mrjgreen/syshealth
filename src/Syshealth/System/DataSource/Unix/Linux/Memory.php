<?php namespace Syshealth\System\DataSource\Unix\Linux;

use Syshealth\System\DataParser\KeyValueParser;
use Syshealth\System\DataSource\DataSourceAbstract;
use Syshealth\System\Entity\MemoryEntity;

class Memory extends DataSourceAbstract
{
    public function __construct()
    {
        parent::__construct('cat /proc/meminfo', new KeyValueParser());
    }

    public function getMemoryInfo()
    {
        $data = $this->readData();

        return new MemoryEntity($data['MemTotal'], $data['MemFree'], $data['MemCached'], $data['SwapTotal'], $data['SwapFree']);
    }
}