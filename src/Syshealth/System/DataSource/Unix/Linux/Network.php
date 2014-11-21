<?php namespace Syshealth\System\DataSource\Unix\Linux;

use Syshealth\System\DataParser\NetParser;
use Syshealth\System\DataSource\DataSourceAbstract;
use Syshealth\System\Entity\NetworkInterfaceEntity;


class Network extends DataSourceAbstract
{
    public function __construct()
    {
        //parent::__construct('cat /proc/net/dev', new NetParser());
    }

    public function getNetworkUsage()
    {
        $data = array(
            array('em1', 0, 0)
        );

        $network = array_map(function($row){
            return $this->createEntity($row);
        }, $data);

        return $network;
    }

    private function createEntity($row)
    {
        return new NetworkInterfaceEntity($row[0], $row[1], $row[2]);
    }
}