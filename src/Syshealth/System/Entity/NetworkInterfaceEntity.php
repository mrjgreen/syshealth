<?php namespace Syshealth\System\Entity;

class NetworkInterfaceEntity
{
    public $interface;

    public $rx;

    public $tx;

    public function __construct($interface, $rx, $tx)
    {
        $this->interface = $interface;

        $this->rx = (float)$rx;

        $this->tx = (float)$tx;
    }
}