<?php namespace Syshealth\System\DataSource\Unix\Linux;

use Syshealth\System\DataParser\TableParser;
use Syshealth\System\DataSource\DataSourceAbstract;
use Syshealth\System\Entity\CpuEntity;


class Cpu extends DataSourceAbstract
{
    const SKIP_FIRST_LINES = 3;

    public function __construct()
    {
        parent::__construct('mpstat -P ALL', new TableParser(self::SKIP_FIRST_LINES));
    }

    public function getCpuUsage()
    {
        $data = $this->readData();

        $cpus = array_map(function($row){
            return $this->createEntity($row);
        }, $data);

        return array(array_shift($cpus), $cpus);
    }

    private function createEntity($row)
    {
        return new CpuEntity($row['CPU'], $row['%usr'], $row['%nice'], $row['%sys'], $row['%irq'], $row['%soft'], $row['%steal'], $row['%guest'], $row['%idle']);
    }
}