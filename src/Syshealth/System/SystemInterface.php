<?php namespace Syshealth\System;


use Syshealth\System\Entity\SystemEntity;

interface SystemInterface
{
    /**
     * @return SystemEntity
     */
    public function getSystemStatus();
}
