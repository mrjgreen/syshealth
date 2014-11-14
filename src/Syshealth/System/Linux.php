<?php namespace Syshealth\System;

class Linux
{
    public function getInfo()
    {
        $loadAvg = sys_getloadavg();
    }

    public function getDisks()
    {
        $disks = shell_exec('df');
    }

    public function getCpus()
    {

    }
}
