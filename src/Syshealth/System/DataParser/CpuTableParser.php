<?php namespace Syshealth\System\DataParser;

class CpuTableParser extends TableParser
{
    protected function parseTableLine($line, $isHeader = false)
    {
        /**
         * cpu 525767 5 322183 6288550 258060 22 12420 0 0
         * cpu0 525767 5 322183 6288550 258060 22 12420 0 0
         */
        if(!preg_match('/^cpu(\d*)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)(?:\s+(\d+))?(?:\s+(\d+))?/', $line, $matches))
        {
            return false;
        }

        $line = array_slice($matches, 1);

        isset($line[8]) or $line[8] = 0;
        isset($line[9]) or $line[9] = 0;

        return $line;
    }
}