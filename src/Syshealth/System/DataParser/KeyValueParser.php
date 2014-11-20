<?php namespace Syshealth\System\DataParser;

class KeyValueParser implements ParserInterface
{
    public function parse($data)
    {
        $lines = explode("\n", $data);

        $final = array();

        foreach($lines as $line)
        {
            $lineParts = explode(':', $line);

            if(count($lineParts) === 2)
            {
                list($key, $value) = $lineParts;

                $final[trim($key)] = trim($value);
            }
        }

        return $final;
    }
}