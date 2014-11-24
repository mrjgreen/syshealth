<?php namespace Syshealth\System\DataParser;

class TableParser implements ParserInterface
{
    protected $skipLines;

    protected $useHeadingsFromFirstRow = true;

    public function __construct($skipLines = 0, $useHeadingsFromFirstRow = true)
    {
        $this->skipLines = $skipLines;

        $this->useHeadingsFromFirstRow = (bool)$useHeadingsFromFirstRow;
    }

    public function parse($data)
    {
        $lines = array_slice(explode("\n", $data), $this->skipLines);

        if(!count($lines))
        {
            return array();
        }

        $headings = false;


        if($this->useHeadingsFromFirstRow)
        {
            $firstLine = $this->parseTableLine(array_shift($lines), true);

            $headings = $firstLine;
        }

        $final = array();

        foreach($lines as $line)
        {
            if(($cols = $this->parseTableLine($line)) !== false)
            {
                $final[] = $headings ? array_combine($headings, $cols) : $cols;
            }
        }

        return $final;
    }

    protected function parseTableLine($line, $isHeader = false)
    {
        return preg_split('/\s+/', $line);
    }
}