<?php namespace Syshealth\System\DataSource;


use Syshealth\System\DataParser\ParserInterface;

abstract class DataSourceAbstract
{
    private $dataSource;

    /**
     * @var ParserInterface
     */
    private $dataParser;

    public function __construct($dataSource, ParserInterface $dataParser = null)
    {
        $this->dataParser = $dataParser;

        $this->dataSource = $dataSource;
    }

    protected function readData()
    {
        $data = trim(shell_exec($this->dataSource));

        if(!$data)
        {
            throw new \Exception("No data returned from source $this->dataSource");
        }

        return $this->dataParser ? $this->dataParser->parse($data) : $data;
    }
}