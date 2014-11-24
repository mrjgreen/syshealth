<?php namespace Syshealth\System\DataSource\Unix\Linux;

use Syshealth\System\DataParser\CpuTableParser;
use Syshealth\System\DataSource\DataSourceAbstract;
use Syshealth\System\Entity\CpuEntity;


class Cpu extends DataSourceAbstract
{
    public function __construct()
    {
        parent::__construct('cat /proc/stat', new CpuTableParser());
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
        $pcent = $this->calculatePercentage(array_slice($row, 1));

        return new CpuEntity($row[0], $pcent[0], $pcent[1], $pcent[2], $pcent[4], $pcent[5], $pcent[6], $pcent[7], $pcent[8], $pcent[3]);
    }

    private function calculatePercentage($row)
    {
        $totalCpu = array_sum($row) ?: 1;

        return array_map(function($val) use($totalCpu){
            return round($val / $totalCpu * 100, 2);
        }, $row);
    }
}