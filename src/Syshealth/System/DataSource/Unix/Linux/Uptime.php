<?php namespace Syshealth\System\DataSource\Unix\Linux;

use Syshealth\System\DataParser\PregSplitParser;
use Syshealth\System\DataSource\DataSourceAbstract;

class Uptime extends DataSourceAbstract
{
    public function __construct()
    {
        parent::__construct('cat /proc/uptime', new PregSplitParser());
    }

    public function getUptimeInSeconds()
    {
        $data = $this->readData();

        return $data[0];
    }
}