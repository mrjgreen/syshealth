<?php namespace Syshealth\System\DataSource\Unix\Linux;

use Syshealth\System\DataParser\CpuTableParser;
use Syshealth\System\DataSource\DataSourceAbstract;
use Syshealth\System\Entity\CpuEntity;


class Cpu extends DataSourceAbstract
{
    private $lastCalulation = array();

    public function __construct()
    {
        parent::__construct('cat /proc/stat', new CpuTableParser());
    }

    public function getCpuUsage()
    {
        $data = $this->readData();

        $cpus = array();
        foreach($data as $i => $row)
        {
            $cpus[$i] = $this->createEntity($i, $row);
        }

        return array(array_shift($cpus), $cpus);
    }

    private function createEntity($i, $row)
    {
        $dataValues = array_slice($row, 1);

        $averages = $this->calculateAverages($i, $dataValues);

        $pcent = $this->calculatePercentage($averages);

        return new CpuEntity($row[0], $pcent[0], $pcent[1], $pcent[2], $pcent[4], $pcent[5], $pcent[6], $pcent[7], $pcent[8], $pcent[3]);
    }

    private function calculateAverages($i, $data)
    {
        foreach($data as $count => $value)
        {
            if(!isset($this->lastCalulation[$i][$count])) $this->lastCalulation[$i][$count] = 0;

            $data[$count] = $value - $this->lastCalulation[$i][$count];

            $this->lastCalulation[$i][$count] = $value;
        }

        return $data;
    }

    private function calculatePercentage($row)
    {
        $totalCpu = array_sum($row) ?: 1;

        return array_map(function($val) use($totalCpu){
            return round($val / $totalCpu * 100, 2);
        }, $row);
    }
}