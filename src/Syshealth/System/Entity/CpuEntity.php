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

    public function __construct($number, $usr, $nice, $sys, $irq, $soft, $steal, $guest, $idle)
    {
        $this->number = $number;

        $this->usr = $usr;

        $this->nice = $nice;

        $this->sys = $sys;

        $this->irq = $irq;

        $this->soft = $soft;

        $this->steal = $steal;

        $this->guest = $guest;

        $this->idle = $idle;

        $this->used = 100 - $idle;
    }
}