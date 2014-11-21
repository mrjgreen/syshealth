<?php namespace Syshealth\System\DataParser;

class NetParser extends TableParser
{
    public function __construct()
    {
        parent::__construct($skipLines = 2, $useHeadingsFromFirstRow = false);
    }

    protected function parseTableLine($line, $isHeader = false)
    {
        preg_match('/^(.+):\s*(\d+)(?:\s+\d+){7}\s+(\d+)/', trim($line), $matches);

        return array_slice($matches, 1);
    }
}