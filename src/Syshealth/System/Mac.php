<?php namespace Syshealth\System;

use Syshealth\System\DataSource\Host;
use Syshealth\System\DataSource\LoadAverage;
use Syshealth\System\DataSource\Unix\Mac\Cpu;
use Syshealth\System\DataSource\Unix\Disk;
use Syshealth\System\DataSource\Unix\Mac\Memory;
use Syshealth\System\DataSource\Unix\Mac\Uptime;

class Mac extends SystemAbstract
{
    public function __construct()
    {
        parent::__construct(
            new Cpu(),
            new LoadAverage(),
            new Disk(),
            new Uptime(),
            new Host(),
            new Memory()
        );
    }
}
