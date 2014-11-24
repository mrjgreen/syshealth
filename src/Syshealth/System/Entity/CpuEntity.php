<?php namespace Syshealth\System\Entity;

class CpuEntity
{
    public $number;

    public $usr;

    public $nice;

    public $sys;

    public $irq;

    public $soft;

    public $steal;

    public $guest;

    public $idle;

    public $used;

    public function __construct($number, $usr, $nice, $sys, $iowait, $irq, $soft, $steal, $guest, $idle)
    {
        $this->number = $number;

        $this->usr = (float)$usr;

        $this->nice = (float)$nice;

        $this->sys = (float)$sys;

        $this->irq = (float)$irq;

        $this->soft = (float)$soft;

        $this->iowait = (float)$iowait;

        $this->steal = (float)$steal;

        $this->guest = (float)$guest;

        $this->idle = (float)$idle;

        $this->used = 100 - $idle;
    }
}