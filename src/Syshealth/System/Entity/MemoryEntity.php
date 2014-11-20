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
        $this->memoryTotal = $memoryTotal;

        $this->memoryUsed = $memoryTotal - $memoryFree;

        $this->memoryCached = $memoryCached;

        $this->memoryFree = $memoryFree;

        $this->swapUsed = $swapTotal - $swapFree;

        $this->swapTotal = $swapTotal;

        $this->swapFree = $swapFree;
    }
}