<?php namespace Syshealth\System\DataSource\Unix\Mac;

use Syshealth\System\DataParser\PregSplitParser;
use Syshealth\System\DataSource\DataSourceAbstract;

class Uptime extends DataSourceAbstract
{
    public function __construct()
    {
        parent::__construct('sysctl -n kern.boottime | cut -c14-18');
    }

    public function getUptimeInSeconds()
    {
        return $this->readData();
    }
}