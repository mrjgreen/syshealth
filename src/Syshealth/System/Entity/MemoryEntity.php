<?php namespace Syshealth\System\Entity;

class MemoryEntity
{
    public $memoryTotal;

    public $memoryUsed;

    public $memoryFree;

    public $memoryCached;

    public $swapTotal;

    public $swapUsed;

    public $swapFree;

    public function __construct($memoryTotal, $memoryFree, $memoryCached, $swapTotal, $swapFree)
    {
        $this->memoryTotal = (int)$memoryTotal;

        $this->memoryCached = (int)$memoryCached;

        $this->memoryFree = (int)$memoryFree;

        $this->memoryUsed = $this->memoryTotal - $this->memoryFree;

        $this->swapTotal = (int)$swapTotal;

        $this->swapFree = (int)$swapFree;

        $this->swapUsed = $this->swapTotal - $this->swapFree;
    }
}