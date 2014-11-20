<?php namespace Syshealth\System\Entity;

class LoadAverage
{
    public $one;

    public $five;

    public $fifteen;

    public function __construct($one, $five, $fifteen)
    {
        $this->one = $one;

        $this->five = $five;

        $this->fifteen = $fifteen;
    }
}