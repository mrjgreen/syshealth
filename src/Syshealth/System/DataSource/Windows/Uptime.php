<?php namespace Syshealth\System\DataSource\Windows;

use Syshealth\System\DataParser\KeyValueParser;
use Syshealth\System\DataSource\DataSourceAbstract;

class Uptime extends DataSourceAbstract
{
    public function __construct()
    {
        parent::__construct('systeminfo | find "Boot Time"', new KeyValueParser());
    }

    public function getUptimeInSeconds()
    {
        $data = $this->readData();

        return time() - strtotime($data['System Boot Time']);
    }
}