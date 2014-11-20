<?php namespace Syshealth\System\DataSource;

class Host
{
    public function getHostName()
    {
        return gethostname();
    }

    public function getHostIp()
    {
        return gethostbyname($this->getHostName());
    }
}