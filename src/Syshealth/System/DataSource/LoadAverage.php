<?php namespace Syshealth\System\DataSource;

use \Syshealth\System\Entity\LoadAverage as LoadAverageEntity;

class LoadAverage
{
    public function getLoadAverage()
    {
        list($one, $five, $fifteen) = sys_getloadavg();

        return new LoadAverageEntity($one, $five, $fifteen);
    }
}