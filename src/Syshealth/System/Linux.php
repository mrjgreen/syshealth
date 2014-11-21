<?php namespace Syshealth\System;

use Syshealth\System\DataSource\Host;
use Syshealth\System\DataSource\LoadAverage;
use Syshealth\System\DataSource\Unix\Linux\Cpu;
use Syshealth\System\DataSource\Unix\Disk;
use Syshealth\System\DataSource\Unix\Linux\Memory;
use Syshealth\System\DataSource\Unix\Linux\Network;
use Syshealth\System\DataSource\Unix\Linux\Uptime;

class Linux extends SystemAbstract
{
    public function __construct()
    {
        parent::__construct(
            new Cpu(),
            new LoadAverage(),
            new Disk(),
            new Uptime(),
            new Host(),
            new Memory(),
            new Network()
        );
    }
}
