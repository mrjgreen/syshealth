<?php namespace Syshealth\System\DataSource\Unix\Mac;

use Syshealth\System\Entity\NetworkInterfaceEntity;


class Network
{
    public function getNetworkUsage()
    {
        return array($this->createEntity());
    }

    private function createEntity()
    {
        return new NetworkInterfaceEntity(0,0,0);
    }
}