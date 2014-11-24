<?php namespace Syshealth\System\DataParser;

class CpuTableParser extends TableParser
{
    protected function parseTableLine($line, $isHeader = false)
    {
        /**
         * cpu 525767 5 322183 6288550 258060 22 12420 0 0
         * cpu0 525767 5 322183 6288550 258060 22 12420 0 0
         */
        preg_match('/^(?:cpu(\d+)|(cpu))\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)(?:\s+(\d+))?(?:\s+(\d+))?/', $line, $matches);

        return array_slice($matches, 1) ?: false;
    }
}