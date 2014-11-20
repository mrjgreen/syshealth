<?php namespace Syshealth\System\DataParser;

class PregSplitParser implements ParserInterface
{
    protected $separator;

    public function __construct($separator = '\s')
    {
        $this->separator = $separator;
    }

    public function parse($data)
    {
        return preg_split("#$this->separator#", $data);
    }
}