<?php namespace Syshealth\System\DataParser;

class CpuTableParser extends TableParser
{
    protected function parseTableLine($line, $isHeader = false)
    {
        preg_match('/^(cpu(?:\d+)?)(?:\s+(\d+)){7}/', $line, $matches);

        return array_slice($matches, 1) ?: false;
    }
}