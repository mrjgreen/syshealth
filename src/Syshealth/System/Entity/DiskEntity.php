<?php namespace Syshealth\System\Entity;

class DiskEntity
{
    public $filesystem;

    public $mount;

    public $total;

    public $used;

    public $free;

    public function __construct($filesystem, $mount, $available, $used)
    {
        $this->filesystem = $filesystem;

        $this->mount = $mount;

        $this->used = (int)$used;

        $this->free = (int)$available;

        $this->total = $this->used + $this->free;
    }
}