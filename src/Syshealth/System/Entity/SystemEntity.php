<?php namespace Syshealth\System\Entity;

use \Syshealth\System\Entity\LoadAverage as LoadAverageEntity;

class SystemEntity
{
    /**
     * @var
     */
    public $hostName;

    /**
     * @var
     */
    public $hostIp;

    /**
     * @var
     */
    public $uptimeSeconds;

    /**
     * @var LoadAverage
     */
    public $loadAverage;

    /**
     * @var MemoryEntity
     */
    public $memoryEntity;

    /**
     * @var array
     */
    public $cpus;

    /**
     * @var CpuEntity
     */
    public $cpu;

    /**
     * @var array
     */
    public $disks;

    /**
     * @var array
     */
    public $networkInterfaces;

    public function __construct($hostName, $hostIp, $uptimeSeconds, LoadAverageEntity $loadAverage, MemoryEntity $memoryEntity, CpuEntity $cpu, array $cpus,  array $disks, array $networkInterfaces)
    {
        $this->hostName = $hostName;

        $this->hostIp = $hostIp;

        $this->uptimeSeconds = (int)$uptimeSeconds;

        $this->loadAverage = $loadAverage;

        $this->memoryEntity = $memoryEntity;

        $this->disks = $disks;

        $this->cpus = $cpus;

        $this->cpu = $cpu;

        $this->networkInterfaces = $networkInterfaces;
    }
}