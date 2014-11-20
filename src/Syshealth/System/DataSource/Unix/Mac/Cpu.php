<?php namespace Syshealth\System\DataSource\Unix\Mac;

use Syshealth\System\Entity\CpuEntity;


class Cpu {

    public function getCpuUsage()
    {
        $data = array(1, 2);

        $cpus = array_map(function($row){
            return $this->createEntity();
        }, $data);

        return array(array_shift($cpus), $cpus);
    }

    private function createEntity()
    {
        return new CpuEntity(0, 0, 0, 0, 0, 0, 0, 0, 0);
    }
}