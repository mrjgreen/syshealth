<?php namespace Syshealth\System\DataParser;

class DfTableParser extends TableParser
{
    protected function parseTableLine($line, $isHeader = false)
    {
        if($isHeader)
        {
            return preg_split('/\s+/', $line, 6);
        }

        preg_match('/^(.+?)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+%)\s+(.+?)$/', $line, $matches);

        return array_slice($matches, 1);
    }
}