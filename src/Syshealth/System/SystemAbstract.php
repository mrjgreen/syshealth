<?php namespace Syshealth\System;

use Syshealth\System\Entity\SystemEntity;

class SystemAbstract implements SystemInterface
{

    protected $cpu;

    protected $loadAverage;

    protected $disk;

    protected $uptime;

    protected $host;

    protected $memory;

    protected $network;

    public function __construct($cpu, $loadAverage, $disk, $uptime, $host, $memory, $network)
    {
        $this->cpu = $cpu;

        $this->loadAverage = $loadAverage;

        $this->disk = $disk;

        $this->uptime = $uptime;

        $this->host = $host;

        $this->memory = $memory;

        $this->network = $network;
    }

    /**
     * @return SystemEntity
     */
    public function getSystemStatus()
    {
        list($cpuAll, $cpus) = $this->cpu->getCpuUsage();

        return new SystemEntity(
            $this->host->getHostName(),
            $this->host->getHostIp(),
            $this->uptime->getUptimeInSeconds(),
            $this->loadAverage->getLoadAverage(),
            $this->memory->getMemoryInfo(),
            $cpuAll,
            $cpus,
            $this->disk->getDiskUsage(),
            $this->network->getNetworkUsage()
        );
    }
}
